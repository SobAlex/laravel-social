<template>
    <div>
        <div class="w-96 mx-auto">
            <div>
                <input v-model="name" type="name" placeholder="name"
                       class="w-96 p-1 mb-2 border border-inherit rounded-lg">
            </div>

            <div>
                <input v-model="email" type="email" placeholder="email"
                       class="w-96 p-1 mb-2 border border-inherit rounded-lg">
            </div>

            <div>
                <input v-model="password" type="password" placeholder="password"
                       class="w-96 p-1 mb-2 border border-inherit rounded-lg">
            </div>

            <div>
                <input v-model="password_confirmation" type="password" placeholder="password_confirmation"
                       class="w-96 p-1 mb-2 border border-inherit rounded-lg">
            </div>

            <div>
                <input @click.prevent="registration" type="submit" value="register"
                class="block float-right mx-auto w-32 p-1 bg-sky-400 text-white rounded-lg">
            </div>

            <div v-if="error" class="text-red-600">{{ this.error }}</div>
        </div>
    </div>
</template>

<script>

export default {

    name: "Registration",

    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            error: null,
        }
    },

    mounted() {
        console.log(localStorage.getItem('access_token'));
    },

    methods: {
        registration() {
            axios.post('/api/users', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
            })
                .then(res => {
                    console.log(res)
                    localStorage.setItem('access_token', res.data.access_token)
                    this.$router.push({name: 'user.personal'})
                })
                .catch(error => {
                    console.log(error)
                    this.error = error.response.data.error
                })
        }
    }
}

</script>

<style scoped>
</style>
