import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),

    routes: [
        {
            path: '/users', component: () => import('../views/user/Index.vue'),
            name: 'user.index'
        },

        {
            path: '/users/login', component: () => import('../views/user/Login.vue'),
            name: 'user.login'
        },

        {
            path: '/users/registration', component: () => import('../views/user/Registration.vue'),
            name: 'user.registration'
        },

        {
            path: '/users/personal', component: () => import('../views/user/Personal.vue'),
            name: 'user.personal'
        },

        // {
        //     path: '*', component: () => import('../views/PageNotFound.vue'),
        //     name: '404'
        // }
    ]
})

router.beforeEach((to, from, next) => {

    const token = localStorage.getItem('access_token')

    if (!token) {
        if (to.name === 'user.login' || to.name === 'user.registration') {
            return next()
        } else {
            return next({
                name: 'user.login'
            })
        }
    }

    if (to.name === 'user.login' || to.name === 'user.registration' && token) {
        return next({
            name: 'user.personal'
        })
    }

    next()

})

export default router
