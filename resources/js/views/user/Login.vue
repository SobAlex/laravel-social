<template>
    <div class="w-96 mx-auto">
        <div>
            <input v-model="email" type="email" placeholder="email" class="w-96 p-1 mb-2 border border-inherit rounded-lg">
        </div>
        <div>
            <input v-model="password" type="password" placeholder="password" class="w-96 p-1 mb-2 border border-inherit rounded-lg">
        </div>
        <div>
            <input @click.prevent="login" type="submit" value="login" class="block float-right mx-auto w-32 p-1 bg-sky-400 text-white rounded-lg">
        </div>
        <div>
            <div v-if="error" class="text-red-600">{{ this.error }}</div>
        </div>
    </div>
</template>

<script>

export default {

    name: "Login",

    data() {
        return {
            email: null,
            password: null,
            error: null,
        }
    },

    methods: {
        login() {
            axios.post('/api/auth/login', {
                email: this.email,
                password: this.password
            })
                .then(res => {
                    localStorage.setItem('access_token', res.data.access_token);
                    this.$router.push({name: 'user.personal'});
                })
                .catch(error => {
                    this.error = error.response.data.error
                })
        }
    }

}

</script>

<style scoped>
</style>
