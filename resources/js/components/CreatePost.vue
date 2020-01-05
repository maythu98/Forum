<template>
    <div class="container p-0">
        <button type="button" class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#createPostModal">
            Create Post
        </button>
        <br><br>
        <CreatePostModal ref="CreatePostModalComponent"/>
        <PostList ref="postListComponent" :user='user'/>
    </div>
</template>
<script>
    import PostList from "./postList";
    import CreatePostModal from "./CreatePostModal";
    export default {
        props : ['user'],
        components: {
            PostList,
            CreatePostModal
        },
        
    }
</script>
