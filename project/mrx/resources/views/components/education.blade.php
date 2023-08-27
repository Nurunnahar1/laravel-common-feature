<section>
    <h2 class="text-secondary fw-bolder mb-4">Education</h2>
    <!-- Education Card 1-->

    <div id="education-list" class="card shadow border-0 rounded-4 mb-5">

        {{-- <div class="card-body p-5">
            <div class="row align-items-center gx-5">
                <div class="col text-center text-lg-start mb-4 mb-lg-0">
                    <div class="bg-light p-4 rounded-4">
                        <div class="text-secondary fw-bolder mb-2">2015 - 2017</div>
                        <div class="mb-2">
                            <div class="small fw-bolder">Barnett College</div>
                            <div class="small text-muted">Fairfield, NY</div>
                        </div>
                        <div class="fst-italic">
                            <div class="small text-muted">Master's</div>
                            <div class="small text-muted">Web Development</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8"><div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus laudantium, voluptatem quis repellendus eaque sit animi illo ipsam amet officiis corporis sed aliquam non voluptate corrupti excepturi maxime porro fuga.</div></div>
            </div>
        </div> --}}

    </div>


</section>
<script>
    educationList();
    async function educationList() {
        try{
            let URL = '/educationData'
            let response = await axios.get(URL);
            response.data.forEach((item) => {
                document.getElementById('education-list').innerHTML+=(`   <div class="card-body p-5">
            <div class="row align-items-center gx-5">
                <div class="col text-center text-lg-start mb-4 mb-lg-0">
                    <div class="bg-light p-4 rounded-4">
                        <div class="text-secondary fw-bolder mb-2">${item['duration']}</div>
                        <div class="mb-2">
                            <div class="small fw-bolder">${item['institutionName']}</div>

                        </div>
                        <div class="fst-italic">
                            <div class="small text-muted">${item['field']}</div>
                         
                        </div>
                    </div>
                </div>
                <div class="col-lg-8"><div>${item['details']}.</div></div>
            </div>
        </div>`)
            })

        }catch(error){
            alert(error)
        }
    }
</script>
