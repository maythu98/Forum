<template>
    <div class="container">
       <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#createPostModal">
        Create Post
        </button>


        <!-- Modal -->
        <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Create Post </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form ref="createPostForm" @submit.prevent="submit">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Body</label>
                    <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Tags</label>
                </div>
            
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="createPost()">Save changes</button>
           
            </div>

            </div>
        </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        methods: {
            createPost() {
                const formData = new FormData(this.$refs['createPostForm']); // reference to form element
                const data = {}; // need to convert it before using not with XMLHttpRequest
                for (let [key, val] of formData.entries()) {
                    Object.assign(data, { [key]: val })
                }
                
                axios.post('/createPost', data);

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
