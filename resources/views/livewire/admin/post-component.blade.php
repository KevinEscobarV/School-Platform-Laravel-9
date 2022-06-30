<div>
    <x-card title="Creacion de Post" cardClasses="border mb-6">
        <x-slot name="action">
            <x-toggle name="published" left-label="Borrador" wire:model.defer="input.is_draft" md />
        </x-slot>
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <x-input label="Título" wire:model="input.title" icon="pencil-alt" placeholder="Título" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-input label="Slug ( Url amigable )" right-icon="eye" wire:model.lazy="input.slug"
                    placeholder="Url Amigable - Se llena automaticamente" disabled />
            </div>
            <div class="col-span-6 sm:col-span-2">
                <x-select label="Categoria" placeholder="Selecciona una categoria" :options="$categories"
                    wire:model.defer="input.category_id" option-label="name" option-value="id" />
            </div>
        </div>

        <x-section-border />

        <div wire:ignore>
            <textarea id="editorPosts">
                <h2 style="text-align:center;">
                    <span class="text-huge" style="font-family:'Trebuchet MS', Helvetica, sans-serif;">Cuerpo de la Publicación</span>
                </h2>
                <p style="text-align:center;"><br data-cke-filler="true"></p>
                <p style="text-align:center;">Contenido</p>
            </textarea>
        </div>

        <x-jet-input-error for="input.body" class="mt-2" />

        <div class="mt-6 flex justify-end">
            <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save" icon="save" primary
                label="Crear Publicación" />
        </div>

    </x-card>

    @push('scripts')
        <script>
            class MyUploadAdapter {
                constructor(loader) {
                    // The file loader instance to use during the upload.
                    this.loader = loader;
                }
                // Starts the upload process.
                upload() {
                    return this.loader.file
                        .then(file => new Promise((resolve, reject) => {
                            this._initRequest();
                            this._initListeners(resolve, reject, file);
                            this._sendRequest(file);
                        }));
                }
                // Aborts the upload process.
                abort() {
                    if (this.xhr) {
                        this.xhr.abort();
                    }
                }
                // Initializes the XMLHttpRequest object using the URL passed to the constructor.
                _initRequest() {
                    const xhr = this.xhr = new XMLHttpRequest();

                    // Note that your request may look different. It is up to you and your editor
                    // integration to choose the right communication channel. This example uses
                    // a POST request with JSON as a data structure but your configuration
                    // could be different.
                    xhr.open('POST', '{{ route('posts.images') }}', true);
                    xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                    xhr.responseType = 'json';
                }
                // Initializes XMLHttpRequest listeners.
                _initListeners(resolve, reject, file) {
                    const xhr = this.xhr;
                    const loader = this.loader;
                    const genericErrorText = `No se pudo cargar el archivo: ${ file.name }.`;

                    xhr.addEventListener('error', () => reject(genericErrorText));
                    xhr.addEventListener('abort', () => reject());
                    xhr.addEventListener('load', () => {
                        const response = xhr.response;
                        // This example assumes the XHR server's "response" object will come with
                        // an "error" which has its own "message" that can be passed to reject()
                        // in the upload promise.
                        //
                        // Your integration may handle upload errors in a different way so make sure
                        // it is done properly. The reject() function must be called when the upload fails.
                        if (!response || response.error) {
                            return reject(response && response.error ? response.error.message : genericErrorText);
                        }
                        // If the upload is successful, resolve the upload promise with an object containing
                        // at least the "default" URL, pointing to the image on the server.
                        // This URL will be used to display the image in the content. Learn more in the
                        // UploadAdapter#upload documentation.
                        resolve({
                            default: response.url
                        });
                    });
                    // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                    // properties which are used e.g. to display the upload progress bar in the editor
                    // user interface.
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', evt => {
                            if (evt.lengthComputable) {
                                loader.uploadTotal = evt.total;
                                loader.uploaded = evt.loaded;
                            }
                        });
                    }
                }
                // Prepares the data and sends the request.
                _sendRequest(file) {
                    // Prepare the form data.
                    const data = new FormData();
                    data.append('upload', file);
                    // Important note: This is the right place to implement security mechanisms
                    // like authentication and CSRF protection. For instance, you can use
                    // XMLHttpRequest.setRequestHeader() to set the request headers containing
                    // the CSRF token generated earlier by your application.
                    // Send the request.
                    this.xhr.send(data);
                }
            }

            function MyCustomUploadAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    // Configure the URL to the upload script in your back-end here!
                    return new MyUploadAdapter(loader);
                };
            }
            ClassicEditor
                .create(document.querySelector('#editorPosts'), {
                    extraPlugins: [MyCustomUploadAdapterPlugin],
                })
                .then(function(editor) {
                    editor.model.document.on('change:data', () => {
                        @this.set('input.body', editor.getData())
                        let data = Array.from(new DOMParser().parseFromString(editor.getData(), 'text/html')
                                .querySelectorAll('img'))
                            .map(img => img.getAttribute('src'))
                        @this.set('urls', data)
                    })
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</div>
