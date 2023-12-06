
<template>
   <div>
  <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">

    <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">

      <div class="mb-4">
        <h1 class="font-serif text-3xl font-bold underline decoration-gray-400">Visualiser Article</h1>
      </div>

      <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
        <form method="POST" action="#">
          <!-- Title -->
          <div>
	     <!-- Section Image -->
       	    <img class="w-full" :src="article.image" :alt="article.titre">	
            <h3 class="text-2xl font-semibold">{{ article.titre }}</h3>
            <div class="flex items-center mb-4 space-x-2">
              <span class="text-xs text-gray-500">{{ article.created_at }}</span>
              <span class="text-xs text-gray-500">{{ article.user ? article.user.name : 'Auteur inconnu' }}</span>
            </div>
            <p class="text-base text-gray-700">{{ article.contenu }}</p>
          </div>
        
          <div class="text-base text-gray-700">
         
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ article.categorie }}</span>
          <template v-if="article.is_published">
           <p class="text-xs text-gray-500">Publié</p>
          </template>
          <template v-else>
            <p class="text-xs text-gray-500">Non publié</p>
          </template>
          
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

</template>



<script>
import axios from 'axios';

export default {
  name: 'ShowArticleComponent',
  
  data() {
  return {
    article: {},
    articleId: null,  // Ajouter articleId ici
  };
},created() {
  this.articleId = this.$route.params.id;
},
  
mounted() {
  if (this.articleId) {
    axios.get(`http://localhost:8000/api/article/${this.articleId}`)
      .then(response => {
        this.article = response.data;
      })
      .catch(error => {
        console.error("Erreur lors de la récupération de l'article: ", error);
      });
  } else {
    console.error("articleId est undefined");
  }
}
}
</script>