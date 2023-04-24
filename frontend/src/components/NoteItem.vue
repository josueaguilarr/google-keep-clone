<template>
  <div class="row justify-start flex-wrap">
    <q-item
      clickable
      class="col-xs-12 col-sm-6 col-md-3"
      v-for="{ title, content, id, isFixed, isArchived } in notes"
      v-bind:key="id"
      @click="contentNotes[id].status = true"
    >
      <q-dialog
        v-model="contentNotes[id].status"
        @hide="
          actionFunctions.fnUpdateNote(
            id,
            contentNotes[id].title,
            contentNotes[id].content
          )
        "
      >
        <q-card style="min-width: 550px; z-index: 1">
          <q-card-section>
            <q-input dense autofocus v-model="contentNotes[id].title" />
          </q-card-section>

          <q-card-section class="q-pt-none">
            <q-input dense autofocus v-model="contentNotes[id].content" />
          </q-card-section>

          <q-card-actions align="right">
            <q-btn flat label="Cerrar" color="primary" v-close-popup />
          </q-card-actions>
        </q-card>
      </q-dialog>

      <q-card flat bordered class="my-card" style="width: 100%">
        <q-card-section class="row justify-between items-center">
          <div class="text-subtitle2 text-capitalize">{{ title }}</div>
          <q-btn
            flat
            round
            :icon="isFixed == 1 ? 'push_pin' : 'o_push_pin'"
            class="text-grey-8"
            @click="actionFunctions.fnUpdateFixed(id, isFixed)"
            @click.stop="actionFunctions.fnUpdateNote()"
          >
            <q-tooltip
              v-if="isFixed == 1"
              class="text-weight-bold text-caption bg-grey-9"
              anchor="bottom middle"
              self="top start"
              :delay="1000"
              :offset="[0, 5]"
              >Dejar de fijar la nota</q-tooltip
            >
            <q-tooltip
              v-else
              class="text-weight-bold text-caption bg-grey-9"
              anchor="bottom middle"
              self="top start"
              :delay="1000"
              :offset="[0, 5]"
              >Fijar la nota</q-tooltip
            >
          </q-btn>
        </q-card-section>

        <q-card-section class="q-pt-none text-subtitle1 text-capitalize">
          {{ content }}
        </q-card-section>
        <q-card-section class="row justify-end items-center text-grey-9">
          <q-btn
            flat
            round
            :icon="isArchived == 1 ? 'o_unarchive' : 'o_archive'"
            class="text-grey-9"
            style="font-size: 0.8em"
            @click="
              isArchived == 0
                ? actionFunctions.fnArchiveNote(id)
                : actionFunctions.fnUnarchiveNote(id)
            "
            @click.stop="actionFunctions.fnUpdateNote()"
          >
            <q-tooltip
              class="text-weight-bold text-caption bg-grey-9"
              anchor="bottom middle"
              self="top start"
              :delay="1000"
              :offset="[0, 5]"
              >Archivar</q-tooltip
            >
          </q-btn>
          <q-btn
            flat
            round
            icon="o_delete"
            class="text-grey-9"
            style="font-size: 0.8em"
            @click="actionFunctions.fnDeleteNote(id)"
            @click.stop="actionFunctions.fnUpdateNote()"
          >
            <q-tooltip
              class="text-weight-bold text-caption bg-grey-9"
              anchor="bottom middle"
              self="top start"
              :delay="1000"
              :offset="[0, 5]"
              >Eliminar</q-tooltip
            >
          </q-btn>
        </q-card-section>
      </q-card></q-item
    >
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "ItemNote",
  setup() {},
  data() {
    return {
      contentNotes: [],
      actionFunctions: [],
    };
  },
  mounted() {
    this.setContentNotes();
    this.setFunctions();
  },
  props: {
    notes: {
      type: Array,
      required: true,
    },
    content: {
      type: Array,
      required: true,
    },
    funciones: {
      type: Object,
      required: true,
    },
  },
  methods: {
    setContentNotes() {
      this.contentNotes = this.content;
    },
    setFunctions() {
      this.actionFunctions = this.funciones;
    },
  },
  updated() {},
});
</script>
