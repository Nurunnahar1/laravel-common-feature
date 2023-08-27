<section>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="text-primary fw-bolder mb-0">Experience</h2>
        <a target="_blank" class="btn btn-primary px-4 py-3" id="CVDownloadLink" href="">
            <div  class="d-inline-block bi bi-download me-2"></div>
            Download Resume
        </a>
    </div>

    <!-- Experience Card 1-->
    <div id="experience-list" class="card shadow border-0 rounded-4 mb-5">

        {{-- <div class="card-body p-5">
            <div class="row align-items-center gx-5">
                <div class="col text-center text-lg-start mb-4 mb-lg-0">
                    <div class="bg-light p-4 rounded-4">
                        <div class="text-primary fw-bolder mb-2">2019 - Present</div>
                        <div class="small fw-bolder">Web Developer</div>
                        <div class="small text-muted">Stark Industries</div>
                        <div class="small text-muted">Los Angeles, CA</div>
                    </div>
                </div>
                <div class="col-lg-8"><div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus laudantium, voluptatem quis repellendus eaque sit animi illo ipsam amet officiis corporis sed aliquam non voluptate corrupti excepturi maxime porro fuga.</div></div>
            </div>
        </div> --}}

    </div>



</section>
<script>

    getResumeLink();
    async function getResumeLink() {
        try {
            let URL = '/resumeLink';

        //loaer show
        document.getElementById('loading-div').classList.remove('d-none')
        document.getElementById('content-div').classList.add('d-none')


            let response = await axios.get(URL);
             let link = response.data['downloadLink'];
             document.getElementById('CVDownloadLink').setAttribute('href',link);
            }


        catch (error) {
            alert(error)
        }

    }

    experienceList();
    async function experienceList() {
        try {
            let URL = '/experienceData'
            let response = await axios.get(URL);
            response.data.forEach((item) => {
                document.getElementById('experience-list').innerHTML += (`
                <div class="card-body p-5">
                 <div class="row align-items-center gx-5">
                    <div class="col text-center text-lg-start mb-4 mb-lg-0">
                            <div class="bg-light p-4 rounded-4">
                                <div class="text-primary fw-bolder mb-2">${item['duration']}</div>
                                <div class="small fw-bolder">${item['title']}</div>
                                <div class="small text-muted">${item['designation']}</div>

                            </div>
                    </div>
                    <div class="col-lg-8"><div>${item['details']}</div></div>
                 </div>
                </div>`)
            })

        } catch (error) {
            alert(error)
        }
    }
</script>
