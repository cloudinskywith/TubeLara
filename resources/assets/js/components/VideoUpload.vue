<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload</div>
                    <div class="panel-body">
                        <input type="file" name="video" id="video" @change="fileInputChange" v-if="!uploading">
                        <div id="video-form" v-if="uploading &&!failed">
                            Form
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                uid:'',
                uploading: false,
                uploadingComplete: false,
                failed: false,
                title: 'Untitled',
                description: null,
                visibility: 'private',
            }
        },
        methods: {
            fileInputChange(){
                this.uploading = true;
                this.failed = false;
                this.file = document.getElementById('video').files[0];

                this.store().then(() => {

                });
                console.log("File Change");
            },
            store(){
                return this.$http
                    .post('/video', {
                        title: this.title,
                        description: this.description,
                        visibility: this.visibility,
                        extension: this.file.name.split('.').pop()
                    })
                    .then((response) => {
                        console.log(response.data.data.uid);
                        this.uid = response.data.data.uid;
                    });
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
        }
    }
</script>
