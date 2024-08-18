<template lang="">
    <div class="w-96 mx-auto">
        <div class="mt-2.5">
          <input v-model="title" type="text" class="w-96 p-1 mb-2 border border-inherit rounded-lg" placeholder="title">
        </div>

        <div class="mt-2.5">
          <textarea v-model="content" rows="4" class="w-96 p-1 mb-2 border border-inherit rounded-lg" placeholder="content"></textarea>
        </div>

        <div class="flex mb-3 items-center">
            <div>
                <input @change="storeImage" ref="file" type="file" class="hidden">
                <a href="#" class="block p-2 w-16 text-center text-sm rounded-3xl bg-sky-500 text-white" @click.prevent="selectFile()">Image</a>
            </div>

            <div>
                <a v-if="image" @click.prevent="image = null" class="ml-3" href="#">Cancel</a>
            </div>

        </div>

        <div class="mt-2 mb-3" v-if="image">
                <img :src="image.url" alt="preview">
        </div>

        <div>
            <input @click.prevent="store" class="block float-right p-2 w-32 text-center text-sm rounded-lg bg-sky-500 text-white" type="submit" value="Publish">
        </div>

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
            title: '',
            content: '',
            image: null,
            posts: []
        }
    },

    components: {
        Post
    },

    mounted() {
        this.getPosts()
    },

    methods: {

        store() {
            const id = this.image ? this.image.id : null
            api.post('/api/posts', { title: this.title, content: this.content, image_id: id })
                .then(res => {
                    this.title = ''
                    this.content = ''
                    this.image = null
                    this.posts.unshift(res.data.data)
                })
        },

        getPosts() {
            api.get('/api/posts')
                .then(res => {
                    this.posts = res.data.data
                })
        },

        selectFile() {
            this.fileInput = this.$refs.file;
            this.fileInput.click();
        },

        storeImage(e) {
            const file = e.target.files[0]
            const formData = new FormData()
            formData.append('image', file)

            api.post('/api/post_images', formData)
                .then(res => {
                    this.image = res.data.data
                })
                .catch(error => {
                    this.error = error.response.data.error
                })
        }
    },

}
</script>

<style lang="">

</style>
