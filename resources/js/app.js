import "./bootstrap";
import { createApp } from "vue";
import router from "./components/router/index";
const app = createApp({});

import ExampleComponent from "./components/ExampleComponent.vue";
app.component("example-component", ExampleComponent);

app.use(router);
app.mount("#app");
