import {createApp} from "vue"
import {createWebHistory, createRouter} from "vue-router"
import App from './components/App.vue'
import ContactList from './components/ContactList.vue'
import ContactCreate from './components/ContactCreate.vue'
import ContactShow from './components/ContactShow.vue'
import ContactEdit from './components/ContactEdit.vue'
import UserProfile from './components/UserProfile.vue'
import Login from './components/Login.vue'
import PageNotFound from './components/PageNotFound.vue'
import axios, {AxiosError, AxiosResponse} from "axios";
import {createPinia} from "pinia";
import {useUserStore} from "./stores/user";
import {useAlertStore} from "./stores/alert";

const app = createApp(App)

// axios setup
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.withCredentials = true
app.provide('$axios', axios)

// pinia
const pinia = createPinia()
app.use(pinia)


// routes setup
const routes = [
    {
        path: "/profile",
        name: "UserProfile",
        component: UserProfile,
        meta: {
            middleware: "auth"
        }
    }, {
        path: "/",
        name: "ContactList",
        component: ContactList,
        meta: {
            middleware: "auth"
        }
    }, {
        path: "/contacts/create",
        name: "ContactCreate",
        component: ContactCreate,
        meta: {
            middleware: "auth"
        }
    },
    {
        path: "/contacts/:id/edit",
        name: "ContactEdit",
        component: ContactEdit,
        props: true,
        meta: {
            middleware: "auth"
        }
    },
    {
        path: "/contacts/:id",
        name: "ContactShow",
        component: ContactShow,
        props: true,
        meta: {
            middleware: "auth"
        }
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: {
            middleware: "guest"
        }
    },
    {
        path: "/:pathMatch(.*)*",
        name: "404",
        component: PageNotFound,
        meta: {
            middleware: "guest"
        }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

const user = useUserStore()
const alert = useAlertStore()

router.beforeEach((to, from, next) => {
    alert.clear()
    if (to.meta.middleware == "guest") {
        if (user.authenticated) {
            next({name: "ContactList"})
        }
        next()
    } else {
        if (user.authenticated) {
            next()
        } else {

            axios.get('/api/user').then((response) => {
                user.setAuthenticatedUser(response.data)
                next()
            })
                .catch(() => {
                    next({name: "Login"})

                })

        }
    }
})

app.use(router)


app.mount('#app')