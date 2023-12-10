<?php

namespace App\Http\Controllers;

use App\Models\UserDates;
use App\Models\Categories;
use App\Models\Types;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserDatesController extends Controller
{
    protected $result1 = [];
    protected $header1 = [];
    protected $result2 = [];
    protected $header2 = [];
    protected $result3 = [];
    protected $header3 = [];
    protected $general = [];
    protected $backgroundColor = [];

    public function index($id)
    {
        return Inertia::render('Costs', [
            'id' => $id
        ]);
    }

    public function wallet(Request $request, $id)
    {
        $data = UserDates::with('category', 'type')->where('users_id', Auth::id())->where('types_id', $id);
        if (isset($request->month)) {
            $data = $data->whereMonth('date', ($request->month + 1));
        }
        $data = $data->get();
        $categories = Categories::where('types_id', $id)->where('users_id', Auth::id())->get();
        return response()->json([
            'data' => $data,
            'categories' => $categories
        ]);
    }

    function statistic()
    {
        $categories = Categories::where('users_id', Auth::id())->get();
        $types = Types::get();
        return Inertia::render('Statistic', [
            'categories' => $categories,
            'types' => $types
        ]);
    }

    function exportExcel(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $model = UserDates::where('users_id', Auth::id())->with('category', 'type');

        if (isset($request->types_id)) {
            $model = $model->where('types_id', $request->types_id);
        }

        if (isset($request->categories_id)) {
            $model = $model->where('categories_id', $request->categories_id);
        }

        if (isset($request->month)) {
            $model = $model->whereMonth('date', ($request->month + 1));
        }

        $data = $model->get();

        $header = [
            "A" => "Дата",
            "B" => "Тип",
            "C" => "Категорія",
            "D" => "Сума",
            "E" => "Коментар"
        ];

        foreach ($header as $key => $value) {
            $sheet->setCellValue($key . 1, $value);
        }

        $nextIndex = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $nextIndex, $item['date']);
            $sheet->setCellValue('B' . $nextIndex, $item['type']['title']);
            $sheet->setCellValue('C' . $nextIndex, $item['category']['title']);
            $sheet->setCellValue('D' . $nextIndex, $item['sum']);
            $sheet->setCellValue('E' . $nextIndex, $item['comment']);
            $nextIndex += 1;
        }

        $writer = new Xlsx($spreadsheet);

        return $this->generateFileExcel($writer, 'Data.xlsx');
    }

    function apiStatistic(Request $request)
    {
        $model = UserDates::where('users_id', Auth::id())->with('category', 'type');

        if (isset($request->types_id)) {
            $model = $model->where('types_id', $request->types_id);
        }

        if (isset($request->categories_id)) {
            $model = $model->where('categories_id', $request->categories_id);
        }

        if (isset($request->month)) {
            $model = $model->whereMonth('date', ($request->month + 1));
        }

        $countPublication = clone $model;
        $countPublication = $countPublication->count();

        $data = [];

        $this->generatePieChart($model);

        $data['pie'] = [
            'labels' => $this->header1,
            'datasets' => [[
                'label' => "Всього",
                'backgroundColor' => $this->backgroundColor,
                'data' => $this->result1
            ]]
        ];

        $this->generateColumnBarChart($model, $request);
        $result2 = [];
        foreach ($this->result2 as $key => $value) {
            array_push($result2, [
                'label' => $value[0],
                'backgroundColor' => '#' . $this->random_color(),
                'data' => array_slice($value, 1)
            ]);
        }

        $data['bar'] = [
            'labels' => array_values($this->header2),
            'datasets' => $result2
        ];

        $this->generateColumnLineChart($model);

        $data['line'] = [
            'labels' => $this->header3,
            'datasets' => [[
                'label' => "Сума",
                'backgroundColor' => '#ffffff',
                'borderColor' => '#88B702',
                'data' => $this->result3
            ]]
        ];

        return response()->json($data);
    }


    function generalStatistic(Request $request)
    {
        $course = Http::timeout(160)->get("https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5")->json();
        $income = UserDates::where('users_id', Auth::id())->whereMonth('date', ($request->month + 1))->where('types_id', 1);
        $costs = UserDates::where('users_id', Auth::id())->whereMonth('date', ($request->month + 1))->where('types_id', 2);
        $savings = UserDates::where('users_id', Auth::id())->whereMonth('date', ($request->month + 1))->where('types_id', 3);

        if (isset($request->categories_id)) {
            $income = $income->where('categories_id', $request->categories_id);
            $costs = $costs->where('categories_id', $request->categories_id);
            $savings = $savings->where('categories_id', $request->categories_id);
        }

        $income = $income->sum('sum');
        $costs = $costs->sum('sum');
        $savings = $savings->sum('sum');

        $remains = $income - ($costs + $savings);

        $data = [
            'income' => $income,
            'costs' => $costs,
            'savings' => $savings,
            'remains' => $remains
        ];

        if (Auth::user()['currency'] == 'EUR') {
            $data['EUR'] = [
                'income' => round($income / $course[0]['buy'], 2),
                'costs' => round($costs / $course[0]['buy'], 2),
                'savings' => round($savings / $course[0]['buy'], 2),
                'remains' => round($remains / $course[0]['buy'], 2)
            ];
        }

        if (Auth::user()['currency'] == 'USD') {
            $data['USD'] = [
                'income' => round($income / $course[1]['buy'], 2),
                'costs' => round($costs / $course[1]['buy'], 2),
                'savings' => round($savings / $course[1]['buy'], 2),
                'remains' => round($remains / $course[1]['buy'], 2)
            ];
        }

        return response()->json($data);
    }

    function generatePieChart($model)
    {
        $general = Types::get();
        foreach ($general as $key => $value) {
            $query = clone $model;
            $this->backgroundColor[$key] = '#' . $this->random_color();
            $this->header1[$key] = $value->title;
            $this->result1[$key] = $query->where('types_id', $value->id)->sum('sum');
        }
    }

    function generateColumnBarChart($model, $request)
    {

        $models = [];
        $general = [];

        $general = Categories::where('users_id', Auth::id())->where('types_id', $request['types_id'])->get();

        foreach ($general as $key => $value) {
            $this->result2[$key] = [$value->title];
            $query = clone $model;
            array_push($models, $query->where('categories_id', $value->id));
        }

        $indicator = Categories::where('users_id', Auth::id())->where('types_id', $request['types_id'])->get();

        foreach ($models as $key => $value) {
            foreach ($indicator as $k => $v) {
                $this->header2[$k + 1] = $v->title;
                $query = clone $value;
                array_push($this->result2[$key], $query->where('categories_id', $v->id)->sum('sum'));
            }
        }
    }

    function generateColumnLineChart($model)
    {

        $general = UserDates::where('users_id', Auth::id())->distinct('date')->pluck('date');
        foreach ($general as $key => $value) {
            $query = clone $model;
            $this->header3[$key] = $value;
            $this->result3[$key] = $query->where('date', $value)->sum('sum');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Categories::firstOrCreate(
            [
                'title' => $request['category'],
                'users_id' => Auth::id(),
                'types_id' => $request['types_id']
            ],
            [
                'types_id' => $request['types_id'],
                'title' => $request['category']
            ]
        );
        $response = UserDates::create([
            'date' => $request['date'],
            'sum' => $request['sum'],
            'comment' => $request['comment'],
            'users_id' => Auth::id(),
            'categories_id' => $category['id'],
            'types_id' => $request['types_id']
        ]);
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $category = Categories::firstOrCreate(
            [
                'title' => $data['category'],
                'users_id' => Auth::id()
            ],
            [
                'types_id' => $data['types_id'],
                'title' => $data['category']
            ]
        );
        UserDates::find($id)->update([
            'date' => $request['date'],
            'sum' => $request['sum'],
            'comment' => $request['comment'],
            'categories_id' => $category['id']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        UserDates::find($id)->delete();
    }

    function random_color_part()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    function random_color()
    {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

    function generateFileExcel($writer, $fileName): StreamedResponse
    {
        $response = new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            }
        );

        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
}
