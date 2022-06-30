<div>
    <x-card title="Realizar entrega" cardClasses="border">
        <div class="grid grid-cols-6 gap-6">
            <!-- Titulo -->
            <div class="col-span-6 sm:col-span-6">
                <x-input right-icon="pencil" label="Título" placeholder="Titulo de la entrega"
                    wire:model.defer="input.titulo" />
            </div>
            <!-- Contenido -->
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="editorEntrega" value="Contenido" />
                <div wire:ignore>
                    <div>
                        <textarea id="editorEntrega">
                                </textarea>
                    </div>
                </div>
                <x-jet-input-error for="input.contenido" class="mt-2" />
            </div>
            @if ($school_work->files)
                <!-- Subir Archivos -->
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="files" value="Subir Archivos" />
                    
                    <label for="file-upload" class="cursor-pointer">
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                </svg>
                                <div class="text-sm text-gray-600">
                                    <div
                                        class="relative bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Subir Archivos</span>
                                        <input id="file-upload" name="file-upload" wire:model="files_paths" type="file"
                                            accept=".doc,.docx,.pdf,.txt,.jpeg,.png,.jpg,.gif,.svg,.xls,.xlsx,.ppt,.pptx,.zip,.rar"
                                            class="sr-only" multiple>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500">DOC, DOCX, PDF, TXT, JPEG, PNG, JPG, GIF, SVG, XLS,
                                    XLSX, PPT, PPTX, ZIP, RAR</p>
                                <p class="text-xs text-gray-500">hasta 10 MB</p>
                            </div>
                        </div>
                    </label>
                </div>
            @endif
            <!-- Archivos subidos -->
            @if ($files_paths)
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="files" value="Archivos" />
                    <x-jet-input-error for="files_paths.*" />
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            @foreach ($files_paths as $file)
                                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                    <div class="w-0 flex-1 flex items-center">
                                        <!-- Heroicon name: solid/paper-clip -->
                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 flex-1 w-0 truncate">
                                            {{ $file->getClientOriginalName() }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </dd>
                </div>
            @endif
        </div>
        <x-slot name="footer">
            <div class="flex justify-end items-center">
                <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save" icon="check" teal
                    label="Realizar Entrega" />
            </div>
        </x-slot>
    </x-card>
    @push('scripts')
        <script>
            class MyUploadAdapter {
                constructor(loader) {
                    this.loader = loader;
                }
                upload() {
                    return this.loader.file
                        .then(file => new Promise((resolve, reject) => {
                            this._initRequest();
                            this._initListeners(resolve, reject, file);
                            this._sendRequest(file);
                        }));
                }
                abort() {
                    if (this.xhr) {
                        this.xhr.abort();
                    }
                }
                _initRequest() {
                    const xhr = this.xhr = new XMLHttpRequest();

                    xhr.open('POST', '{{ route('entrega.images') }}', true);
                    xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                    xhr.responseType = 'json';
                }
                _initListeners(resolve, reject, file) {
                    const xhr = this.xhr;
                    const loader = this.loader;
                    const genericErrorText = `No se pudo cargar el archivo: ${ file.name }.`;

                    xhr.addEventListener('error', () => reject(genericErrorText));
                    xhr.addEventListener('abort', () => reject());
                    xhr.addEventListener('load', () => {
                        const response = xhr.response;
                        if (!response || response.error) {
                            return reject(response && response.error ? response.error.message : genericErrorText);
                        }
                        resolve({
                            default: response.url
                        });
                    });
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', evt => {
                            if (evt.lengthComputable) {
                                loader.uploadTotal = evt.total;
                                loader.uploaded = evt.loaded;
                            }
                        });
                    }
                }
                _sendRequest(file) {
                    const data = new FormData();
                    data.append('upload', file);
                    this.xhr.send(data);
                }
            }

            function MyCustomUploadAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return new MyUploadAdapter(loader);
                };
            }
            ClassicEditor
                .create(document.querySelector('#editorEntrega'), {
                    extraPlugins: [MyCustomUploadAdapterPlugin],
                })
                .then(function(editor) {
                    editor.model.document.on('change:data', () => {
                        @this.set('input.contenido', editor.getData())
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
