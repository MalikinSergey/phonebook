<script setup lang="ts">

import {inject, onMounted, reactive} from "vue";
import {AxiosResponse, AxiosStatic} from "axios";
import {useRouter} from "vue-router";
import Contact from "../interface/Contact";

const $axios = inject('$axios') as AxiosStatic;

const state = reactive<{ contacts: Contact[] }>({contacts: []})

const router = useRouter();

onMounted(() => {
  fetchContacts()
})

const fetchContacts = () => {
  $axios.get('/api/contacts')
      .then((response: AxiosResponse) => {
        state.contacts = response.data;
      })
}

const toggleFav = (contact: Contact) => {
  $axios.put(`/api/contacts/${contact.id}/set-favorite`, {favorite: !contact.favorite ? 1: 0})
      .then((response: AxiosResponse) => {

        let found = state.contacts.find((c: { id: string }) => c.id === contact.id)

        if (found) {
          found.favorite = !contact.favorite;
        }

      })
}

</script>

<template>

  <div v-if="state.contacts.length" class="contact-list">
    <div v-for="contact in state.contacts" class="contact-list__item d-f ai-c jc-sb">
      <router-link class="contact-list__show" :to="`/contacts/${contact.id}`">
        <div class="contact-list__name">{{ contact.name }}</div>
        <div>{{ contact.number }}</div>
      </router-link>

      <div class="d-f ai-c">

        <div @click="toggleFav(contact)" class="mr-16 contact-list__fav" :class="{'contact-list__fav--fill': contact.favorite}"></div>

        <router-link class="mspb-button mspb-button--secondary mspb-button--small" :to="`/contacts/${contact.id}/edit`">edit</router-link>
      </div>

    </div>
  </div>

  <div class="contact-list__empty" v-else>
    Your contact list is empty now. Add your first contact!
  </div>

</template>
