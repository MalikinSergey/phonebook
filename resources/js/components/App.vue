<script setup lang="ts">

import {inject, onMounted, reactive} from "vue";
import {AxiosResponse, AxiosError, AxiosStatic} from "axios";
import {useRouter} from "vue-router";
import Alert from "./Alert.vue";
import {useUserStore} from "../stores/user";

const $axios = inject('$axios') as AxiosStatic;

const userStore = useUserStore()

const router = useRouter();

const logOut = () => {

  $axios.delete('/logout')
      .then((response: AxiosResponse) => {
        userStore.logout()
        router.push('/login')
      }).catch((error: AxiosError) => {

  })

}

</script>

<template>

  <div class="mspb-layer">
    <div class="mspb-container pt-128 d-f jc-c ai-c">

      <div class="mspb-card mspb-card--medium">
        <div class="mspb-card__title">Phonebook</div>

        <div v-if="userStore.authenticated">
          <div class="d-f jc-sb ai-c mb-16">
            <div class="mspb-card__subtitle">{{ userStore.user.name }} ({{ userStore.user.email }})</div>
            <div @click="logOut" class="mspb-button mspb-button--secondary mspb-button--small">log out</div>
          </div>

          <div class="d-f mb-16">
            <router-link class="mspb-button mspb-button--small mspb-button--secondary mr-4" to="/">My contacts</router-link>
            <router-link class="mspb-button mspb-button--small mspb-button--secondary" to="/contacts/create">Add contact</router-link>
          </div>
        </div>

        <alert></alert>

        <router-view></router-view>

      </div>

    </div>
  </div>

</template>