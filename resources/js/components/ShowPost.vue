<template>
    <div class="container">
        <h1> {{ post.title }} </h1>
        <p> {{post.body}} </p>
    </div>
</template>

<script>
import { log } from 'util';
export default {
    props: ['postID'],
     data() {
        return {
            post: [],
        }
    },
    methods: { 
        showPost() {
            axios.get('/showPost/'+ this.postID).then(response => {
                this.post = response.data;
            });
        },
    },
    mounted() {        
        this.showPost();
    }
}
</script>

<style>

</style>