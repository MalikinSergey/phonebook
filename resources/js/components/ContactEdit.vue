<script setup lang="ts">

import {inject, onMounted, reactive} from "vue";
import {AxiosResponse, AxiosError, AxiosStatic} from "axios";
import {useRouter} from "vue-router";
import {useAlertStore} from "../stores/alert";
import Contact from "../interface/Contact";

const $axios = inject('$axios') as AxiosStatic;

const router = useRouter();

const alert = useAlertStore()

const props = defineProps<{
  id: string
}>()

const state = reactive<{contact: Contact}>({
  contact: {id: '', name: '', number: '', favorite: false}
})

onMounted(() => {
  fetchContact()
})

const fetchContact = () => {
  $axios.get(`/api/contacts/${props.id}`)
      .then((response: AxiosResponse) => {
        state.contact = response.data
      })
}

const updateContact = () => {

  $axios.put(`/api/contacts/${props.id}/update`, state.contact)
      .then((response: AxiosResponse) => {
        router.push('/')
      })
      .catch((error: AxiosError) => {

        if (error.response?.data.errors) {
          alert.setValidationErrors(error.response?.data.errors)
        }

      })
}

const destroyContact = () => {

  $axios.delete(`/api/contacts/${props.id}/destroy`)
      .then((response: AxiosResponse) => {
        router.push('/')
      })
}

</script>

<template>

  <form @submit.prevent="updateContact" method="post" action="">

    <div class="mspb-form-group mb-16">
      <label class="mspb-label" for="name">Contact name</label>
      <input id="name" class="mspb-input" type="text" name="name" v-model="state.contact.name"/>
    </div>

    <div class="mspb-form-group mb-16">
      <label class="mspb-label" for="number">Contact number</label>
      <input id="number" class="mspb-input" type="text" name="number" v-model="state.contact.number"/>
    </div>

    <button type="submit" class="mspb-button mspb-button--primary mr-4">Update</button>

    <button @click="destroyContact" class="mspb-button mspb-button--attentive">Delete</button>

  </form>

</template>
