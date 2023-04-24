<template>
  <div
    class="col-xs-12 col-sm-12 col-md-12 q-pa-md q-gutter-md q-mt-md"
    style="height: 90px"
  >
    <q-expansion-item
      class="overflow-hidden shadow-5"
      switch-toggle-side
      style="border-radius: 10px; width: 50%; margin: auto"
      label="Añade una nota..."
      header-class="bg-white text-grey-8 text-weight-medium text-body1"
      expand-icon-class="text-white"
      icon="o_check_box"
    >
      <div class="row no-wrap justify-end" @click="cardNotExpand">
        <q-btn
          v-if="isFixed"
          flat
          round
          icon="push_pin"
          class="text-grey-8 q-mr-sm"
          @click="fixedNote"
        >
          <q-tooltip
            class="text-weight-bold text-caption bg-grey-9"
            anchor="bottom middle"
            self="top start"
            :delay="1000"
            :offset="[0, 5]"
            >Dejar de fijar la nota</q-tooltip
          >
        </q-btn>

        <q-btn
          v-else
          flat
          round
          icon="o_push_pin"
          class="text-grey-8 q-mr-sm"
          @click="fixedNote"
        >
          <q-tooltip
            class="text-weight-bold text-caption bg-grey-9"
            anchor="bottom middle"
            self="top start"
            :delay="1000"
            :offset="[0, 5]"
            >Fijar la nota</q-tooltip
          >
        </q-btn>
      </div>
      <q-card @click="cardNotExpand">
        <q-card-section class="text-dark q-pt-none">
          <form @submit.prevent="postNote">
            <q-input v-model="title" :dense="dense" placeholder="Título" />
            <q-input
              v-model="content"
              :dense="dense"
              placeholder="Añade una nota..."
            />
            <q-btn
              color="secondary"
              label="Guardar"
              type="submit"
              class="q-mt-md"
            />
          </form>
        </q-card-section>
      </q-card>
    </q-expansion-item>
  </div>
</template>

<script>
import { ref, defineComponent } from "vue";
import { api } from "boot/axios";

export default defineComponent({
  name: "InputAddNote",
  setup() {
    return {
      dense: ref(true),
    };
  },
  data() {
    return {
      title: "",
      content: "",
      isFixed: false,
    };
  },
  props: {
    getNotes: Function,
    expanded: Function,
  },
  methods: {
    fixedNote() {
      this.isFixed = !this.isFixed;
    },
    postNote() {
      if (this.title == "" && this.content == "") return;

      const data = {
        title: this.title,
        content: this.content,
        isFixed: this.isFixed == true ? 1 : 0,
      };

      api
        .post("api/v1/notes", data)
        .then((response) => {
          this.getNotes();
          this.title = "";
          this.content = "";
          this.isFixed = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    cardNotExpand() {
      this.expanded();
    },
  },
});
</script>
