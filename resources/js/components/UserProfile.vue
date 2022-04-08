<script setup lang="ts">

import {inject, onMounted, reactive} from "vue";
import {AxiosResponse, AxiosError, AxiosStatic} from "axios";
import {useRoute} from "vue-router";
import User from "../interface/User";

const $axios = inject('$axios') as AxiosStatic;

const state = reactive<User>({
  name: '',
  email: ''
})

const fetchUser = () => {
  $axios.get('/api/user')
      .then((response: AxiosResponse) => {
        state.name = response.data.name
        state.email = response.data.email
      })
}

</script>

<template>

        <p>Name: {{ state.name }}</p>
        <p>Email: {{ state.email }}</p>

</template>
