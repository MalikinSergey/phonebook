import {defineStore} from 'pinia'
import User from "../interface/User";

export const useUserStore = defineStore('user', {
    state: (): {user: User, authenticated: boolean} => {
        return {user: {}, authenticated: false}
    },
    actions: {
        setAuthenticatedUser(user: User) {
            this.user = user
            this.authenticated = true
        },
        logout() {
            this.user = {}
            this.authenticated = false
        }
    }

})