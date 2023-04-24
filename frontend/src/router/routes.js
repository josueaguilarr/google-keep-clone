const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "/notes",
        component: () => import("src/pages/IndexNotes.vue"),
      },
      {
        path: "/archive",
        component: () => import("src/pages/IndexNotesArchived.vue"),
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
