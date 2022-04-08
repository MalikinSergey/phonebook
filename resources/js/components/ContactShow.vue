<script setup lang="ts">

import {inject, onMounted, reactive} from "vue";
import {AxiosResponse, AxiosStatic} from "axios";
import Contact from "../interface/Contact";

const $axios = inject('$axios') as AxiosStatic;

const props = defineProps<{
  id: string
}>()

const state = reactive<{ contact: Contact }>({
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

</script>

<template>

  <div class="contact-data mb-32">
    <div class="mb-16">Contact name:</div>
    <div class="mb-16"><b>{{ state.contact.name }}</b></div>
    <div class="mb-16">Number:</div>
    <div class="mb-16"><b>{{ state.contact.number }}</b></div>
  </div>

  <router-link :to="`/contacts/${state.contact.id}/edit`" type="submit" class="mspb-button mspb-button--primary mr-4">Edit contact</router-link>

</template>
