<template>
    <div class="answer flex gap-3 py-5">
        <img :src="item.user.photo" class="avatar mt-2">
        <div class="w-full">
            <div class="answer-user">
                {{ item.user.name }} {{ item.user.surname }}
                <span class="date">{{ item.created_at }}</span>
            </div>
            <p>{{ item.description }}</p>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        item: Object
    }
}
</script>
<style scoped>
.answer {
    align-items: flex-start;
    border-bottom: 1px solid #424242;
}

p {
    margin: 0;
    font-size: 15px;
    line-height: 22px;
}

.date {
    font-size: 14px;
    color: #9099a3;
}

img.avatar {
    width: 35px;
    height: 35px;
    object-fit: cover;
    border-radius: 50%;
}

.answer-user {
    margin-bottom: 7px;
    display: flex;
    justify-content: space-between;
}

.answer-user .description {
    margin-top: 5px;
    font-size: 14px;
    color: #9099a3;
    line-height: 1em;
    padding: 0;
}
</style>