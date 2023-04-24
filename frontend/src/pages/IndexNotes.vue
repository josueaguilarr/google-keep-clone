<template>
  <q-page v-if="withoutNotes">
    <NoteInputAdd :expanded="expandedCard" @click="expandedCard" />
    <div
      class="flex flex-center column q-mt-xl"
      :class="[cardExpanded ? expanded : notExpanded]"
    >
      <div class="q-mt-xl">
        <q-icon name="o_lightbulb" color="grey-4" size="7.5rem" />
      </div>
      <p class="text-h5 text-grey-7 q-pa-lg">
        Las notas que añadas aparecerán aquí
      </p>
    </div>
  </q-page>

  <q-page>
    <NoteInputAdd
      :getNotes="getNotes"
      :expanded="expandedCard"
      @click="expandedCard"
    />
    <div
      style="padding: 0 6rem"
      :class="[cardExpanded ? expanded : notExpanded]"
    >
      <p class="text-overline text-uppercase text-grey-8 q-px-lg q-ma-none">
        Fijadas
      </p>
      <ItemNote
        :notes="fixedNotes"
        :content="dataNotes"
        :funciones="{
          fnUpdateFixed: updateFixed,
          fnUpdateNote: updateNote,
          fnArchiveNote: archiveNote,
          fnDeleteNote: deleteNote,
        }"
      />
    </div>

    <div class="q-mt-xl" style="padding: 0 6rem">
      <p class="text-overline text-uppercase text-grey-8 q-px-lg q-ma-none">
        Otras
      </p>
      <ItemNote
        :notes="notFixednotes"
        :content="dataNotes"
        :funciones="{
          fnUpdateFixed: updateFixed,
          fnUpdateNote: updateNote,
          fnArchiveNote: archiveNote,
          fnDeleteNote: deleteNote,
        }"
      />
    </div>
  </q-page>
</template>

<script>
import { api } from "boot/axios";
import NoteInputAdd from "src/components/NoteInputAdd.vue";
import ItemNote from "src/components/NoteItem.vue";

export default {
  components: {
    NoteInputAdd,
    ItemNote,
  },
  data() {
    return {
      withoutNotes: true,
      notFixednotes: [],
      fixedNotes: [],
      dataNotes: [],
      cardExpanded: false,
      expanded: "expanded",
      notExpanded: "notExpanded",
    };
  },
  mounted() {
    this.getNotes();
  },
  methods: {
    getNotes() {
      api
        .get("api/v1/notes")
        .then((response) => {
          const { data } = response;
          data.forEach((note) => {
            this.dataNotes[note.id] = {
              status: false,
              title: note.title,
              content: note.content,
            };
          });
          this.notFixednotes = response.data.filter(
            (note) => note.isFixed == 0
          );
          this.fixedNotes = response.data.filter((note) => note.isFixed == 1);
          this.withoutNotes = response.data.length == 0;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    updateFixed(id, isFixed) {
      const data = {
        isFixed: isFixed == 1 ? 0 : 1,
      };

      api
        .put(`api/v1/notes/${id}`, data)
        .then((response) => {
          this.getNotes();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    updateNote(id, currentTitle, currentContent) {
      if (currentTitle == undefined && currentContent == undefined) return;

      const data = {
        title: currentTitle,
        content: currentContent,
      };

      api
        .put("api/v1/notes/" + id, data)
        .then((response) => {
          this.getNotes();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    archiveNote(id) {
      const data = {
        isFixed: 0,
        isArchived: 1,
      };

      api
        .post(`api/v1/notes/${id}/archived`, data)
        .then((response) => {
          this.getNotes();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteNote(id) {
      api
        .delete(`api/v1/notes/${id}`)
        .then((response) => {
          this.getNotes();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    expandedCard() {
      this.cardExpanded = !this.cardExpanded;
    },
  },
  updated() {},
};
</script>

<style lang="scss" scoped>
.child {
  width: 25%;
  height: 20vh;
  gap: 2px;
}

.expanded {
  margin-top: 200px;
  transition: all 0.5s ease;
}

.notExpanded {
  margin-top: 0px;
  transition: all 0.5s ease;
}

@media (max-width: 768px) {
  .child {
    width: 100%;
    height: 100%;
    margin-bottom: 10px;
  }
}

@media (max-width: 400px) {
  .child {
    width: 100%;
    height: 100%;
    margin-bottom: 10px;
  }
}
</style>
