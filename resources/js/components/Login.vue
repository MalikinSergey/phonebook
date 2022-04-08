<script setup lang="ts">

import {inject, reactive} from "vue";
import {AxiosResponse, AxiosError, AxiosStatic} from "axios";
import {useRouter} from "vue-router";
import {useAlertStore} from "../stores/alert";

const $axios = inject('$axios') as AxiosStatic;

const router = useRouter();

const errors = useAlertStore()

const state = reactive({
  authenticated: false,

  credentials: {
    email: '',
    password: ''
  }
})

const login = () => {

  $axios.post('/login', state.credentials)
      .then((response: AxiosResponse) => {
        router.push('/')
      })
  .catch((error: AxiosError) => {

    if (error.response?.data.errors) {
      errors.setValidationErrors(error.response?.data.errors)
    }

  })

}

</script>

<template>

  <form @submit.prevent="login" method="post" action="">

    <div class="mspb-form-group mb-16">
      <label class="mspb-label" for="email">Email</label>
      <input id="email" class="mspb-input" type="text" name="email" v-model="state.credentials.email"/>
    </div>

    <div class="mspb-form-group mb-16">
      <label class="mspb-label" for="password">Password</label>
      <input id="password" class="mspb-input" type="password" name="password" v-model="state.credentials.password"/>
    </div>

    <div class="d-f ai-c">
      <button type="submit" class="mspb-button mspb-button--primary">Sign in</button>
      <div class="mr-16 ml-16">or</div>
      <a href="/register" class="link link--primary">register</a>

      <div class="ml-8">
        (<a href="/forgot-password" class="link link--primary">forgot password?</a>)
      </div>
    </div>

  </form>

</template>