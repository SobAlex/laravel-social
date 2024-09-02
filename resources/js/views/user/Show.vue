<template lang="">
    <div class="w-96 mx-auto">
        <Stat :stats="stats"></Stat>

        <div v-if="posts" class="mt-16">
            <h1>Post</h1>
            <Post v-for="post in posts" :post="post"></Post>
        </div>
    </div>
</template>

<script>

import api from '../../api';
import Post from '../../components/Post.vue';
import Stat from "../../components/Stat.vue";

export default {
    name: 'Personal',

    data() {
        return {
            posts: [],
            userId: this.$route.params.id,
            stats: []
        }
    },

    components: {
        Post,
        Stat
    },

    mounted() {
        this.getPosts()
        this.getStats()
    },

    methods: {

        getStats() {
            api.post('/api/users/stats', { user_id: this.userId})
                .then( res => {
                    this.stats = res.data.data
                })
        },

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
