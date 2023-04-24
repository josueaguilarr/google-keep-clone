<template>
  <q-item
    clickable
    style="border-radius: 0px 30px 30px 0"
    :to="link"
    active-class="my-menu-link"
    exact
  >
    <q-item-section v-if="icon" avatar>
      <q-icon :name="icon" color="grey-8" />
    </q-item-section>

    <q-item-section>
      <q-item-label>{{ title }}</q-item-label>
    </q-item-section>
  </q-item>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "NavegationLinks",
  props: {
    title: {
      type: String,
      required: true,
    },

    icon: {
      type: String,
      default: "",
    },

    link: {
      type: String,
      default: "#",
    },
  },
});
</script>

<style lang="scss">
.my-menu-link {
  color: black;
  background: #feefc3;
}
</style>
