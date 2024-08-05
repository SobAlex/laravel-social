<template>

    <div class="mb-8 mt-8 pb-6 border-b border-grey-300">
        <h1 class="text-lg font-bold">{{ post.title }}</h1>

        <img class="my-6" v-if="post.image_url" :src="post.image_url" :alt="post.title">

        <p>{{ post.content }}</p>

        <p class="text-sm text-right text-slate-500">{{ post.date }}</p>
    </div>

</template>

<script>
export default {
    name: "Post",

    props: [
        "post"
    ]
}
</script>

<style scoped></style>
