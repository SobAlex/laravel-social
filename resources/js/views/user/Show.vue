<template lang="">
    <div class="w-96 mx-auto">
        <div v-if="posts" class="mt-16">
            <h1>Post</h1>
            <Post v-for="post in posts" :post="post"></Post>
        </div>
    </div>
</template>

<script>

import api from '../../api';
import Post from '../../components/Post.vue';

export default {
    name: 'Personal',

    data() {
        return {
            posts: [],
            userId: this.$route.params.id
        }
    },

    components: {
        Post
    },

    mounted() {
        this.getPosts()
    },

    methods: {
        getPosts() {
            api.get(`/api/users/${this.userId}/posts`)
                .then(res => {
                    this.posts = res.data.data
                })
        }
    },

}
</script>

<style lang="">
</style>
