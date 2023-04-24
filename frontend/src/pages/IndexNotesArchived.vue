<template>
  <q-page v-if="withoutNotesArchived" class="flex flex-center column">
    <div>
      <q-icon name="o_archive" color="grey-4" size="7.5rem" />
    </div>
    <p class="text-h5 text-grey-7 q-pa-lg">
      Tus notas archivadas se mostrarán aquí
    </p>
  </q-page>

  <div class="q-mt-lg" style="padding: 0 6rem">
    <ItemNote
      :notes="notesArchived"
      :content="dataNotes"
      :funciones="{
        fnUpdateFixed: updateFixed,
        fnUpdateNote: updateNote,
        fnUnarchiveNote: unarchiveNote,
        fnDeleteNote: deleteNote,
      }"
    />
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { api } from "boot/axios";
import ItemNote from "src/components/NoteItem.vue";

export default defineComponent({
  name: "IndexNotesArchived",
  components: {
    ItemNote,
  },
  data() {
    return {
      withoutNotesArchived: true,
      notesArchived: [],
      dataNotes: [],
    };
  },
  mounted() {
    this.getNotesArchived();
  },
  methods: {
    getNotesArchived() {
      api
        .get("api/v1/notes/archived")
        .then((response) => {
          const { data } = response;
          data.forEach((note) => {
            this.dataNotes[note.id] = {
              status: false,
              title: note.title,
              content: note.content,
            };
          });
          this.notesArchived = response.data;
          this.withoutNotesArchived = response.data.length == 0;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    updateFixed(id, isFixed) {
      const data = {
        isFixed: isFixed == 1 ? 0 : 1,
        isArchived: 0,
      };

      api
        .put(`api/v1/notes/${id}`, data)
        .then((response) => {
          this.getNotesArchived();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    unarchiveNote(id, isFixed) {
      this.updateFixed(id, !isFixed);
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
          this.getNotesArchived();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteNote(id) {
      api
        .delete(`api/v1/notes/${id}`)
        .then((response) => {
          this.getNotesArchived();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
});
</script>
