
<template>
<!-- Conteneur Flex avec espace horizontal réduit entre les articles -->
<div class="flex flex-row flex-wrap -mx-1">
  <!-- Boucle v-for pour chaque article, avec espace horizontal réduit -->
  <div v-for="article in articles" :key="article.id" class="px-1 w-1/6">
    <!-- Carte de l'article avec espace horizontal réduit -->
    <div class="max-w-sm rounded overflow-hidden shadow-lg">
      <!-- Section Image -->
      <img class="w-full" :src="article.image" :alt="article.titre">
      <!-- Section Contenu de l'Article -->
      <div class="px-3 py-4"> <!-- Ajustez la valeur de px ici -->
        <div class="font-bold text-xl mb-2">{{ article.titre }}</div>
        <p class="text-gray-700 text-base">{{ article.contenu }}</p>
      </div>
      <!-- Section Informations Supplémentaires -->
      <div class="px-3 pt-3 pb-2"> <!-- Ajustez la valeur de px ici -->
        <p class="text-gray-600" v-if="article.is_published">Publié</p>
        <p class="text-gray-600" v-else>Non publié</p>
        <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-sm font-semibold text-gray-700 mr-1 mb-1">#{{ article.categorie }}</span>
      </div>
    </div>
  </div>
</div>

</template>
  
  <script >
  import axios from 'axios';
 

  export default {
    name: 'ListeArticlesComponent',
    data() {
      return {
        articles: []
      };
    },
    mounted() {
      axios.get('http://localhost:8000/api/articles')
        .then(response => {
          this.articles = response.data;
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des articles: ", error);
        });
    }
  };
  </script>
