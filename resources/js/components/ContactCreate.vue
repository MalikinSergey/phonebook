<script setup lang="ts">

import {inject, onMounted, reactive} from "vue";
import {AxiosResponse, AxiosStatic} from "axios";
import {useRouter} from "vue-router";

const $axios = inject('$axios') as AxiosStatic;

const router = useRouter();

const state = reactive({
  contact: {
    name: '',
    number: ''
  }
})

const storeContact = () => {

  $axios.post('/api/contacts/store', state.contact)
      .then((response: AxiosResponse) => {
        router.push('/')
      })

}

</script>

<template>

  <form @submit.prevent="storeContact" method="post" action="">

    <div class="mspb-form-group mb-16">
      <label class="mspb-label" for="name">Contact name</label>
      <input id="name" class="mspb-input" type="text" name="name" v-model="state.contact.name"/>
    </div>

    <div class="mspb-form-group mb-16">
      <label class="mspb-label" for="number">Contact number</label>
      <input id="number" class="mspb-input" type="text" name="number" v-model="state.contact.number"/>
    </div>

    <button type="submit" class="mspb-button mspb-button--primary">Add contact</button>

  </form>

</template>
