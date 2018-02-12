new Vue({
    el: '.publierApp',
    data: {
        photos: []
    },
    created: function () {
        var self = this;
        if (annonce_id != 0) {
            $.getJSON($url + '/annonce/images/' + annonce_id, function (data) {
                if (data.length == 0) {
                    self.init();
                    return;
                }
                var photos = [];
                for (var i = 0; i < data.length; i++) {
                    var value = data[i];
                    photos.push({
                        id: value.id,
                        src: $url + '/uploads/images/' + value.image,
                        uploaded: true,
                        cursor: 'default'
                    });
                }
                if (data.length < 3) {//Le nombre d'image de l'annonce inférieur à 3 on ajoute la différence pour que l'annonce puisse avoir 3 image
                    var dif = 3 - data.length;
                    for (var i = 0; i < dif; i++) {
                        photos.push({
                            id: i,
                            src: $url + '/uploads/images/upload.png',
                            uploaded: false,
                            cursor: 'pointer'
                        });
                    }
                }
                self.photos = photos;
            });


        }
        else {
            self.init();
        }
    },
    methods: {
        init: function () {
            var photos = [{
                id: 1,
                src: $url + '/uploads/images/upload.png',
                uploaded: false,
                cursor: 'pointer'
            }, {
                id: 2,
                src: $url + '/uploads/images/upload.png',
                uploaded: false,
                cursor: 'pointer'
            }, {
                id: 3,
                src: $url + '/uploads/images/upload.png',
                uploaded: false,
                cursor: 'pointer'
            }];
            this.photos = photos;
            //  this.$set('photos',photos);
        },
        upload: function (photo) {
            var self = this;
            var inputfile = $('.photo' + photo.id);
            inputfile.change(function () {
                var file = this.files[0];
                if (this.files && file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        photo.src = e.target.result;
                        photo.uploaded = true;
                    };

                    if (file.size > $image_size) {
                        self.remove(photo);
                        alert("Taille fichier suppérieure à " + $image_size_help);
                        return;
                    }

                    var extensions = ['png', 'gif', 'jpg', 'jpeg'];
                    var extension = file.name.split('.').pop();

                    if (extensions.indexOf(extension) == -1) {
                        self.remove(photo);
                        alert('Format de fichier invalide');
                        return;
                    }

                    reader.readAsDataURL(file);

                }
            });

            inputfile.click();
        },
        remove: function (photo) {
            this.photos.push({
                id: photo.id,
                src: $url + '/uploads/images/upload.png',
                uploaded: false,
                cursor: 'pointer'
            })
            $.get($url + '/annonce/supprimer-image/' + photo.id);
            this.photos.$remove(photo);

        }
    }
});
