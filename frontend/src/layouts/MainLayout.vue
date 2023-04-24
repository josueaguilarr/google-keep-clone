<template>
  <q-layout view="hHh lpR fFf">
    <q-header reveal bordered class="bg-white q-pa-none q-mx-sm">
      <q-toolbar class="q-pa-xs row q-pa-none q-ma-none">
        <q-btn
          dense
          flat
          round
          icon="menu"
          class="text-grey-8 q-pa-none q-ma-none"
          @click="toggleLeftDrawer"
        >
          <q-tooltip
            class="text-weight-bold text-caption bg-grey-9"
            anchor="bottom middle"
            self="top start"
            :delay="1000"
            :offset="[0, 5]"
            >Menú principal</q-tooltip
          >
        </q-btn>

        <q-toolbar-title
          class="col-xs-2 col-sm-3 col-md-2 row no-wrap justify-start items-center text-grey-8 text-weight-medium"
          title="Keep"
        >
          <q-avatar rounded>
            <img
              title="Keep"
              src="https://www.gstatic.com/images/branding/product/1x/keep_2020q4_48dp.png"
            />
          </q-avatar>
          Keep
        </q-toolbar-title>

        <q-toolbar-title
          class="col-xs-3 col-sm-4 col-md-7 row no-wrap justify-start items-center q-px-none"
          style="border-radius: 10px"
        >
          <q-input
            :dense="dense"
            filled
            v-model="text"
            placeholder="Busca lo que quieras"
            class="bg-grey-2"
            style="width: 700px"
          >
            <template v-slot:prepend>
              <q-icon name="search" />
            </template>
            <template v-slot:append>
              <q-icon name="close" @click="text = ''" class="cursor-pointer" />
            </template>
          </q-input>
        </q-toolbar-title>

        <q-toolbar-title
          class="col-xs-2.5 col-sm-1.5 col-md-1.5 row no-wrap justify-evenly items-center"
        >
          <q-btn dense flat round icon="refresh" class="text-grey-8">
            <q-tooltip
              class="text-weight-bold text-caption bg-grey-9"
              anchor="bottom middle"
              self="top start"
              :delay="1000"
              :offset="[0, 5]"
              >Actualizar</q-tooltip
            >
          </q-btn>
          <q-btn dense flat round icon="o_view_agenda" class="text-grey-8">
            <q-tooltip
              class="text-weight-bold text-caption bg-grey-9"
              anchor="bottom middle"
              self="top start"
              :delay="1000"
              :offset="[0, 5]"
              >Vista de lista</q-tooltip
            >
          </q-btn>
          <q-btn dense flat round icon="o_settings" class="text-grey-8">
            <q-tooltip
              class="text-weight-bold text-caption bg-grey-9"
              anchor="bottom middle"
              self="top start"
              :delay="1000"
              :offset="[0, 5]"
              >Ajustes</q-tooltip
            >
          </q-btn>
        </q-toolbar-title>

        <q-toolbar-title
          class="col-xs-2.5 col-sm-1.5 col-md-1.5 row no-wrap justify-evenly items-center"
        >
          <q-btn dense flat round icon="o_apps" class="text-grey-8">
            <q-tooltip
              class="text-weight-bold text-caption bg-grey-9"
              anchor="bottom middle"
              self="top start"
              :delay="1000"
              :offset="[0, 5]"
              >Aplicaciones</q-tooltip
            >
          </q-btn>

          <q-avatar size="32px" color="primary" text-color="white">J</q-avatar>
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-drawer
      show-if-above
      v-model="leftDrawerOpen"
      side="left"
      class="q-mt-sm"
      :breakpoint="725"
    >
      <q-list>
        <NavegationLinks
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from "vue";
import NavegationLinks from "src/components/NavigationLinks.vue";

const linksList = [
  {
    title: "Notas",
    icon: "o_lightbulb",
    link: "/notes",
  },
  {
    title: "Notas archivadas",
    icon: "o_archive",
    link: "/archive",
  },
];

export default defineComponent({
  name: "MainLayout",

  components: {
    NavegationLinks,
  },

  setup() {
    const leftDrawerOpen = ref(false);

    return {
      text: ref(""),
      dense: ref(false),
      essentialLinks: linksList,
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
    };
  },
});
</script>
