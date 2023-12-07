<template>
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
      <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
        <div class="mb-4">
          <h1 class="font-serif text-3xl font-bold underline decoration-gray-400">Editer l'article</h1>
        </div>
  
        <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
          <form @submit.prevent="updateArticle">
            <div>
              <label class="block text-sm font-bold text-gray-700" for="title">Titre</label>
              <input v-model="article.titre" class="block w-full mt-1 border-gray-100 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-white" type="text" placeholder="Entrez le titre" />
            </div>
            <div class="mt-4">
              <label class="block text-sm font-bold text-gray-700" for="description">Description</label> 
              <textarea v-model="article.contenu" class="block w-full mt-1 border-gray-100 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-white" rows="4" placeholder="Entrez la description "></textarea>
            </div>
  
            <div class="mt-4">
              <input v-model="article.categorie" class="block w-full mt-1 border-gray-100 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-white" type="text" placeholder="Entrez la catégorie" />
            </div>
           
           
          
            <div v-if="article" class="mt-4 border p-3 rounded shadow">
            <img :src="article.imageUrl || article.image" 
                 :alt="article.imageUrl ? 'Image actuelle de l\'article' : 'Image par défaut de l\'article'" 
                 class="max-w-full h-auto"/>

                 <div class="mt-4">
              <input type="file" @change="onFileChange" class="block w-full mt-1 border-gray-100 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 bg-white">
            </div>
            
            </div>
            
    
         
        
            
  
            <div class="mt-4">
              <select v-model="selectedUserId" class="block w-full mt-1 border-gray-100 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-white">
                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
              </select>
            </div>
  
            <button id="publishButton" @click="togglePublish" :class="{'bg-blue-500': !article.is_published, 'bg-green-500': article.is_published}" class="text-white px-4 py-2 rounded hover:bg-blue-700">{{ article.is_published ? 'Publié' : 'Non publié' }}</button>
  
            <div class="flex items-center justify-start mt-4 gap-x-2">
              <button type="submit" @click="updateArticle" class="px-6 py-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700">Update</button>
              <button type="button" @click="cancelUpdate" class="px-6 py-2 text-sm font-semibold text-gray-100 bg-gray-400 rounded-md shadow-md hover:bg-gray-600">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </template>
     




     <script>
     import axios from 'axios';
     
     const API_BASE_URL = 'http://localhost:8000/api';
     
     export default {
       name: 'EditArticleComponent',
       data() {
         return {
           users: [],
           selectedUserId: null,
           article: {},
           articleId: null,
           image: null,
           imageChanged:null,
         };
       },
       watch: {
         selectedUserId(newUserId, oldUserId) {
           if (newUserId !== oldUserId) {
             this.updateArticleAuthor(newUserId);
           }
         },
       },
       async created() {
         this.articleId = this.$route.params.id;
         await this.fetchData();
       },
       methods: {
        async updateArticle() {
    try {
        const formData = new FormData();
        // Gestion conditionnelle de l'image
        if (this.image && this.imageChanged) {  // Utilisez 'imageChanged' pour détecter les changements
            formData.append('image', this.image);
        }

        // Ajout des propriétés de l'article au formData, sauf 'image'
        Object.keys(this.article).forEach(key => {
            if (key !== 'image') {
                formData.append(key, this.article[key]);
            }
        });

        // Ajout de 'user_id' si nécessaire
        if (this.selectedUserId) {
            formData.append('user_id', this.selectedUserId);
        }

        // Requête PUT pour la mise à jour de l'article
        const response = await axios.put(
            `${API_BASE_URL}/article/update/${this.articleId}`,
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            }
        );

        console.log('Article mis à jour avec succès', response.data);
        // Gérez ici la réponse, comme la redirection ou la mise à jour de l'interface utilisateur
    } catch (error) {
        console.error("Erreur lors de la mise à jour de l'article: ", error);
        // Gestion des erreurs plus détaillée si nécessaire
    }
},
         async fetchData() {
           try {
             this.users = await this.fetchUsers();
             if (this.articleId) {
               this.article = await this.fetchArticle(this.articleId);
               this.selectedUserId = this.article.user_id;
             } else {
               console.error("articleId est undefined");
             }
           } catch (error) {
             console.error("Erreur lors de la récupération des données: ", error);
           }
         },
     
         async fetchUsers() {
           const response = await axios.get(`${API_BASE_URL}/users`);
           return response.data;
         },
     
         async fetchArticle(articleId) {
           const response = await axios.get(`${API_BASE_URL}/article/edit/${articleId}`);
           return response.data;
         },
     
         togglePublish() {
          this.article.is_published = !this.article.is_published;
         },
     
         updateArticleAuthor(userId) {
           axios.patch(`${API_BASE_URL}/article/update/${this.articleId}`, { user_id: userId })
             .catch(error => console.error("Erreur lors de la mise à jour de l'auteur: ", error));
         },
     
         onFileChange(e) {
           this.image = e.target.files[0];
           this.imageChanged = true;  
},
     
         cancelUpdate() {
           this.article = { titre: '', contenu: '', categorie: '', image: null };
         },

       }
     };
     </script>