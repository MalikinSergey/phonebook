import {defineStore} from 'pinia'

export const useAlertStore = defineStore('errors', {
    state: () => {
        return {validationErrors: {}, error: '', success: ''}
    },
    getters: {
        hasValidationErrors(): number {
            return Object.keys(this.validationErrors).length
        }
    },
    actions: {
        setValidationErrors(errors: {}) {
            this.validationErrors = errors
        },
        setError(error: string) {
            this.error = error
        },
        setSuccess(error: string) {
            this.success = error
        },
        clear() {
            this.validationErrors = {}
            this.error = ''
            this.success = ''
        }
    }

})