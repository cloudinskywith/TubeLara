<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload</div>
                    <div class="panel-body">
                        <input type="file" name="video" id="video" @change="fileInputChange" v-if="!uploading">
                        <div class="alert alert-danger" v-if="failed">Something Went Wrong,Please Try Again</div>

                        <div id="video-form" v-if="uploading &&!failed">
                            <div class="alert alert-info" v-if="!uploadingComplete">Your Will Be available at {{$root.url }}/videos/{{uid}}</div>
                            <div class="alert alert-info" v-if="uploadingComplete">Upload complete.Video is now
                                <a href="{$root.url}videos/{uid}" target="_blank">{{$root.url }}videos/{{uid}}</a>
                            </div>

                            <div class="progress" v-if="!uploadingComplete">
                                <div class="progress-bar" v-bind:style="{width: fileProgress + '%'}"></div>
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" v-model="title">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" v-model="description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="visibility">Visibility</label>
                                <select class="form-control" v-model="visibility">
                                    <option value="private">Private</option>
                                    <option value="unlisted">Unlisted</option>
                                    <option value="public">Public</option>
                                </select>
                            </div>
                            <span class="help-block pull-right">{{ saveStatus }}</span>
                            <button class="btn-default btn" type="submit" @click.prevent="update">Save</button>
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
                uid: null,
                uploading: false,
                uploadingComplete: false,
                failed: false,
                title: 'Untitled',
                description: null,
                visibility: 'private',
                saveStatus: 'Not Save.',
                fileProgress: 0,
            }
        },
        methods: {
            fileInputChange(){
                this.uploading = true;
                this.failed = false;
                this.file = document.getElementById('video').files[0];

                this.store().then(() => {
                    var form = new FormData();
                    form.append('video', this.file);
                    form.append('uid', this.uid);
                    this.$http.post('/upload', form, {
                        progress: (e) => {
                            if (e.lengthComputable) {
                                console.log(e.loaded + ' ' + e.total);
                                this.updateProgress(e);
                            }
                        }
                    }).then(() => {
                        this.uploadingComplete = true;
                    }, () => {
                        this.failed = true;
                    })
                }, () => {
                    this.failed = true;
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
            },
            update(){
                this.saveStatus = 'Saving changes';
                return this.$http
                    .put('/videos/' + this.uid, {
                        title: this.title,
                        description: this.description,
                        visibility: this.visibility
                    })
                    .then((response) => {
                        console.log(response.data.data);
                        this.saveStatus = 'Changes saved';
                        setTimeout(() => {
                            this.saveStatus = '';
                        }, 2000);
                    }, () => {
                        this.saveStatus = 'Failed save';
                    });
            },
            updateProgress(e){
                e.percent = (e.loaded / e.total) + 100;
                this.fileProgress = e.percent;
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
        }
    }
</script>
