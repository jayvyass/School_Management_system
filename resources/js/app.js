import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({
    // You can register global components here if needed
});

app.component('example-component', ExampleComponent);
app.mount('#vue-app');
