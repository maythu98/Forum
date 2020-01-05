<template>
    <div class="container">
        <h1> {{ post.title }} </h1>
        <p> {{post.body}} </p>
        <div class="overall-tags-container">
            <div v-for="tag in post.post_tags" :key="tag.id">
                <span class="little-tag-container"> {{tag.tag.tagName }} </span>
            </div>
        </div>
        
        <!-- Your Feeling -->
        <div class="mt-3">
            <div class="form-group">
                <textarea name="comment" class="form-control" rows="1" placeholder="Add Your Feeling ..." v-model="comment" autofocus></textarea>
            </div>
            <button class="btn btn-primary" @click="saveComment()">Comment</button>
        </div>

        <!-- Other Comments -->
        <div v-for="comment in post.post_comments" :key="comment.id" class="mt-3">
            <label for=""> <b> {{ comment.user.name }} </b>  {{ comment.comment_time }} </label>
            <div>
                {{ comment.comment }}
            </div>
            <hr>
        </div>
    </div>
</template>

<script>
import { log } from 'util';
export default {
    props: ['postID'],
     data() {
        return {
            post: [],
            comment: ''
        }
    },
    methods: { 
        showPost() {
            axios.get('/showPost/'+ this.postID).then(response => {
                this.post = response.data;
            });
        },
        saveComment() {
            const data = {};
            data['comment'] = this.comment;
            axios.post('/saveComment/' + this.postID, data).then(response => {
                this.comment = "";
                this.showPost();
            });
        }
    },
    mounted() {        
        this.showPost();
    }
}
</script>

<style>

</style>