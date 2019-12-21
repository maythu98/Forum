<template>
    <div class="container p-0">
        <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPostModelLabel"> Create Post </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ref="createPostForm" @submit.prevent="submit" >
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="title" id="title" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </form>
                    <div class="form-group">
                        <label for="addedTagName">Tags</label>
                        <input id="addedTagName" type="text" class="form-control">
                        <button class="btn btn-secondary" @click="addTags()"> Next </button>
                    </div>

                    <div class="row flex-row">
                        <div class="p-2 bg-light m-2 rounded-pill " v-for="(tagName, tagNumber) in tags" :key="tagNumber">
                            <span class="px-2"> 
                                {{ tagName }} 
                                <button type="button" class="close" aria-label="Close" @click="removeTag(tagNumber)">
                                    <span aria-hidden="true">&times;</span>
                                </button> 
                            </span>
                        </div>
                    </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="createPost()">Save changes</button>
                </div>
            </div>
        </div>
        </div>

        <div class="container">
            <div class="overall-post-container">  
                <b>{{ createdPost.title }}</b>
                <p>{{createdPost.body}}</p>
                
                <div v-for="tag in createdPost.post_tags">
                    <span class="badge badge-pill badge-info text-white"> {{tag.tagName }} </span>
                </div>
            </div>  

            <div class="overall-post-container" v-for="post in allPosts">
                <b class="overall-post-title">{{ post.title }}</b>
                <p class="overall-post-body">{{post.body}}</p>
                
                <div class="overall-tags-container">
                    <div v-for="tag in post.post_tags">
                        <span class="little-tag-container"> {{tag.tagName }} </span>
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
                tags: [],
                tagName: '',
                tagId: 0,
                createdPost:{},
                allPosts:{}
            }
        },
        methods: {
            
            createPost() {

                const formData = new FormData(this.$refs['createPostForm']); 
                const data = {};
                
                for (let [key, val] of formData.entries()) {
                    Object.assign(data, { [key]: val })
                }

                data['tags'] = this.tags;

                axios.post('/createPost', data).then(response=> {
					console.log(response);
                    this.createdPost = response.data;
                    $('#createPostModal').modal('hide');                    
				});		

            },
            getPosts() {
                axios.get('/getPosts').then(response=> {
                    this.allPosts = response.data;
                });
            },
            addTags() {

                this.tags.push($('#addedTagName').val());
                $('#addedTagName').val('').focus();
            
            },

            removeTag(tagNumber) {

                this.tags.splice(tagNumber,1);

            }
        },
        mounted() {
            console.log('Component mounted.');
            this.getPosts();
        }
    }
</script>
