

import { createApp } from 'vue';
import App from './App.vue'; // Importez votre composant App.vue
import { createRouter, createWebHistory } from 'vue-router';
import ListeArticlesComponent from './components/ListeArticlesComponent.vue';
import ShowArticleComponent from './components/ShowArticleComponent.vue';
import './bootstrap';

// Configuration de Vue Router
const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path:'/articles', component: ListeArticlesComponent },
    { path:'/article/:id', component: ShowArticleComponent }
  ],
});

// Création de l'instance Vue avec le composant App
const app = createApp(App); // Utilisez App ici

// Utilisation de Vue Router
app.use(router);

// Montage de l'application
app.mount('#app');