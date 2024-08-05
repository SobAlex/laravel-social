<template>
    <div class="w-96 mx-auto">
        <div v-if="users">
            <div class="border-b mb-8 pb-8" v-for="user in users">
                <router-link :to="{ name: 'user.show', params: { id: user.id } }">
                    <p>{{ user.id }}</p>
                    <p>{{ user.name }}</p>
                    <p>{{ user.email }}</p>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../../api';


export default {

    name: "Index",

    data() {
        return {
            users: []
        }
    },

    mounted() {
        this.getUsers()
    },

    methods: {
        getUsers() {
            api.get('/api/users')
                .then(res => {
                    this.users = res.data.data
                })
        }
    }

}

</script>

<style scoped></style>
