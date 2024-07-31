<form action="/student/{{ $student->id }}/update" method="post" id="frmStudent" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    </svg>
                </span>
                <input type="hidden" value="{{ $student->id }}">
                <input type="text" value="{{ $student->name }}" name="name" id="name" class="form-control"
                    placeholder="Nama">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-apps">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M14 7l6 0" />
                        <path d="M17 4l0 6" />
                    </svg>
                </span>
                <input type="text" value="{{ $student->nim }}" name="nim" id="nim" class="form-control"
                    placeholder="NIM" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                        <path d="M3 7l9 6l9 -6" />
                    </svg>
                </span>
                <input type="text" value="{{ $student->email }}" name="email" id="email" class="form-control"
                    placeholder="email">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-phone">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    </svg>
                </span>
                <input type="text" value="{{ $student->phone }}" name="phone" id="phone" class="form-control"
                    placeholder="phone">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21l18 0" />
                        <path d="M9 8l1 0" />
                        <path d="M9 12l1 0" />
                        <path d="M9 16l1 0" />
                        <path d="M14 8l1 0" />
                        <path d="M14 12l1 0" />
                        <path d="M14 16l1 0" />
                        <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
                    </svg>
                </span>
                <input type="text" value="{{ $student->university }}" name="university" id="university"
                    class="form-control" placeholder="university">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <select name="gender" id="gender" class="form-select">
                <option value="{{ $student->gender }}">{{ $student->gender }}</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                    </svg>
                </span>
                <input type="text" value="{{ $student->city }}" name="city" id="city"
                    class="form-control" placeholder="city">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                    </svg>
                </span>
                <textarea name="address" id="address" class="form-control" placeholder="address">{{ $student->address }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-polaroid">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M9.199 9.623l.108 .098l3.986 3.986l.094 .083a1 1 0 0 0 1.403 -1.403l-.083 -.094l-.292 -.293l1.292 -1.293l.106 -.095c.457 -.38 .918 -.38 1.386 .011l.108 .098l4.502 4.503a4.003 4.003 0 0 1 -3.596 2.77l-.213 .006h-12a4.002 4.002 0 0 1 -3.809 -2.775l5.516 -5.518l.106 -.095c.457 -.38 .918 -.38 1.386 .011zm8.801 -7.623a4 4 0 0 1 3.995 3.8l.005 .2v6.585l-3.293 -3.292l-.15 -.137c-1.256 -1.095 -2.85 -1.097 -4.096 -.017l-.154 .14l-1.307 1.306l-2.293 -2.292l-.15 -.137c-1.256 -1.095 -2.85 -1.097 -4.096 -.017l-.154 .14l-4.307 4.306v-6.585a4 4 0 0 1 3.8 -3.995l.2 -.005h12zm-2.99 3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" />
                        <path d="M8.01 20a1 1 0 0 1 .117 1.993l-.127 .007a1 1 0 0 1 -.117 -1.993l.127 -.007z" />
                        <path d="M12.01 20a1 1 0 0 1 .117 1.993l-.127 .007a1 1 0 0 1 -.117 -1.993l.127 -.007z" />
                        <path d="M16.01 20a1 1 0 0 1 .117 1.993l-.127 .007a1 1 0 0 1 -.117 -1.993l.127 -.007z" />
                    </svg>
                </span>
                <input type="file" value="" name="photo" id="photo" class="form-control">
                <input type="hidden" name="old_photo" value="{{ $student->photo }}">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <select name="department_id" id="department_id" class="form-select">
                <option value="">Pilih Department</option>
                @foreach ($department as $item)
                    <option {{ $student->department_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <select name="mentor_id" id="mentor_id" class="form-select">
                <option value="">Pilih Mentor</option>
                @foreach ($mentor as $item)
                    <option {{ $student->mentor_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
</form>
