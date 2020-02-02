<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                <router-link class="nav-link" to="/home">Home </router-link>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                <router-link class="nav-link" to="/register">Register</router-link>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link" @click="logout($event)">Log out</a>
                </li>
            </ul>
        
        </div>
    </nav>
</template>

<script>

export default {
    methods: {
        logout(event) {
            event.preventDefault();
            
            this.$store.dispatch('destroyToken')
            .then(response => {
                this.$router.push({ path: '/home' })
            })
        }
    }
}
</script>

<style>

</style>