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
            return{
                uploading:false,
                uploadingComplete:false,
                failed:false,
            }
        },
        methods:{
            fileInputChange(){
                this.uploading = true;
                this.failed = false;


                console.log("File Change");
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
