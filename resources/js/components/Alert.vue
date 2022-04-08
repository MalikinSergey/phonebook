<script setup lang="ts">

import {useAlertStore} from "../stores/alert";

const errors = useAlertStore()

</script>

<template>
  <div class="mspb-alert mspb-alert--error mb-16" v-if="errors.hasValidationErrors">
    <div v-for="validationError in errors.validationErrors">
      <p v-for="validationErrorLine in validationError">{{ validationErrorLine }}</p>
    </div>
  </div>

  <div class="mspb-alert mspb-alert--error" v-if="errors.error">
    <p>{{ errors.error }}</p>
  </div>

  <div class="mspb-alert mspb-alert--success" v-if="errors.success">
    <p>{{ errors.success }}</p>
  </div>

</template>