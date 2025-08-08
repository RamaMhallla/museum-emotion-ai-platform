			<!--begin::Row-->
									<div class="row g-5 g-xl-10">
										<!--begin::Col-->
										<div class="col-xl-4 mb-xl-10">
											<!--begin::Lists Widget 19-->
											<div class="card card-flush h-xl-100">
												<!--begin::Heading-->
												<div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-color:#4A7C7A;"  data-bs-theme="light">
													<!--begin::Title-->
													<h3 class="card-title align-items-start flex-column text-white pt-15">
														<span class="fw-bold fs-2x mb-3">My Visitors</span>
														<div class="fs-4 text-white">
															<span class="opacity-75">You have</span>
															<span class="position-relative d-inline-block">
																<a href='{{ url('artworks') }}' class="link-white opacity-75-hover fw-bold d-block mb-1"  style="color: #88caff">{{ $total_artworks}} ArtWorks</a>
																<!--begin::Separator-->
																<span class="position-absolute opacity-50 bottom-0 start-0 border-2 border-body border-bottom w-100"></span>
																<!--end::Separator-->
															</span>
															<span class="opacity-75">to show</span>
														</div>
													</h3>
													<!--end::Title-->

												</div>
												<!--end::Heading-->
												<!--begin::Body-->
												<div class="card-body mt-n20">
													<!--begin::Stats-->
													<div class="mt-n20 position-relative">
														<!--begin::Row-->
														<div class="row g-3 g-lg-6">
															<!--begin::Col-->
															<div class="col-6">
																<!--begin::Items-->
																<div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
																	<!--begin::Symbol-->
																	<div class="symbol symbol-30px me-5 mb-8">
																		<span class="symbol-label">
																			<i class="ki-duotone ki-flask fs-1 text-primary">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>
																		</span>
																	</div>
																	<!--end::Symbol-->
																	<!--begin::Stats-->
																	<div class="m-0">
																		<!--begin::Number-->
																		<span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ $total_visitors}}</span>
																		<!--end::Number-->
																		<!--begin::Desc-->
																		<span class="text-gray-500 fw-semibold fs-6" >Visitors</span>
																		<!--end::Desc-->
																	</div>
																	<!--end::Stats-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Col-->
															<!--begin::Col-->
															<div class="col-6">
																<!--begin::Items-->
																<div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
																	<!--begin::Symbol-->
																	<div class="symbol symbol-30px me-5 mb-8">
																		<span class="symbol-label">
																			<i class="ki-duotone ki-bank fs-1 text-primary">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>
																		</span>
																	</div>
																	<!--end::Symbol-->
																	<!--begin::Stats-->
																	<div class="m-0">
																		<!--begin::Number-->
																		<span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ $total_users}}</span>
																		<!--end::Number-->
																		<!--begin::Desc-->
																		<span class="text-gray-500 fw-semibold fs-6">Users</span>
																		<!--end::Desc-->
																	</div>
																	<!--end::Stats-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Col-->
															<!--begin::Col-->
															<div class="col-6">
																<!--begin::Items-->
																<div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
																	<!--begin::Symbol-->
																	<div class="symbol symbol-30px me-5 mb-8">
																		<span class="symbol-label">
																			<i class="ki-duotone ki-award fs-1 text-primary">
																				<span class="path1"></span>
																				<span class="path2"></span>
																				<span class="path3"></span>
																			</i>
																		</span>
																	</div>
																	<!--end::Symbol-->
																	<!--begin::Stats-->
																	<div class="m-0">
																		<!--begin::Number-->
																		<span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ $total_captured_emotions}}  </span>
																		<!--end::Number-->
																		<!--begin::Desc-->
																		<span class="text-gray-500 fw-semibold fs-6"> emotions </span>
																		<!--end::Desc-->
																	</div>
																	<!--end::Stats-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Col-->
															<!--begin::Col-->
															<div class="col-6">
																<!--begin::Items-->
																<div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
																	<!--begin::Symbol-->
																	<div class="symbol symbol-30px me-5 mb-8">
																		<span class="symbol-label">
																			<i class="ki-duotone ki-timer fs-1 text-primary">
																				<span class="path1"></span>
																				<span class="path2"></span>
																				<span class="path3"></span>
																			</i>
																		</span>
																	</div>
																	<!--end::Symbol-->
																	<!--begin::Stats-->
																	<div class="m-0">
																		<!--begin::Number-->
																		<span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ $total_artworks}}</span>
																		<!--end::Number-->
																		<!--begin::Desc-->
																		<span class="text-gray-500 fw-semibold fs-6">Artworks</span>
																		<!--end::Desc-->
																	</div>
																	<!--end::Stats-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Col-->
														</div>
														<!--end::Row-->
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Lists Widget 19-->
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-xl-8 mb-5 mb-xl-10">
											<!--begin::Row-->
											<div class="row g-5 g-xl-10">
												<!--begin::Col-->
												<div class="col-xl-6 mb-xl-10">
													<!--begin::Slider Widget 1-->
													<div id="kt_sliders_widget_1_slider" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5000">
														<!--begin::Header-->
														<div class="card-header pt-5">
															<!--begin::Title-->
															<h4 class="card-title d-flex align-items-start flex-column">
																<span class="card-label fw-bold text-gray-800">Today’s Visitors</span>
																<span class="text-gray-400 mt-1 fw-bold fs-7">{{ $today_visitors }} Visitors, {{$today_users }} Users</span>
															</h4>
															<!--end::Title-->
															<!--begin::Toolbar-->
															<div class="card-toolbar">
																<!--begin::Carousel Indicators-->
																<ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-primary">
																	<li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="0" class="active ms-1"></li>
																	<li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="1" class="ms-1"></li>
																	<li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="2" class="ms-1"></li>
																</ol>
																<!--end::Carousel Indicators-->
															</div>
															<!--end::Toolbar-->
														</div>
														<!--end::Header-->
														<!--begin::Body-->
														<div class="card-body py-6">
															<!--begin::Carousel-->
															<div class="carousel-inner mt-n5">
																<!--begin::Item-->
																<div class="carousel-item active show">
																	<!--begin::Wrapper-->
																	<div class="d-flex align-items-center mb-5">
																		<!--begin::Chart-->
																		<div class="w-80px flex-shrink-0 me-2">
																			<div class="min-h-auto ms-n3" id="kt_slider_widget_1_chart_1" style="height: 100px"></div>
																		</div>
																		<!--end::Chart-->
																		<!--begin::Info-->
																		<div class="m-0">
																			<!--begin::Subtitle-->
																			<h4 class="fw-bold text-gray-800 mb-3">Emotions Detected</h4>
																			<!--end::Subtitle-->
																			<!--begin::Items-->
																			<div class="d-flex d-grid gap-5">
																				<!--begin::Item-->
																				<div class="d-flex flex-column flex-shrink-0 me-4">
																					<!--begin::Section-->
																					<span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																					<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>{{ $emotionCounts[4] ?? 0}} Happy</span>
																					<!--end::Section-->
																					<!--begin::Section-->
																					<span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																					<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>{{ $emotionCounts[5] ?? 0 }}  Sad</span>
																					<!--end::Section-->
																				</div>
																				<!--end::Item-->
																				<!--begin::Item-->
																				<div class="d-flex flex-column flex-shrink-0">
																					<!--begin::Section-->
																					<span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																					<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>{{ $emotionCounts[7] ?? 0 }}  Natural</span>
																					<!--end::Section-->
																					<!--begin::Section-->
																					<span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																					<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>{{ $emotionCounts[5] ?? 0 }}  Fear</span>
																					<!--end::Section-->
																				</div>
																				<!--end::Item-->
																			</div>
																			<!--end::Items-->
																		</div>
																		<!--end::Info-->
																	</div>
																	<!--end::Wrapper-->
																	<!--begin::Action-->
																	<div class="m-0">
																		<a href='{{ route('emotions') }}' class="btn btn-sm btn-light me-2 mb-2">Emotions</a>
																		<a href='{{ route('users.index') }}'  class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal">Visitors</a>
																	</div>
																	<!--end::Action-->
																</div>
																<!--end::Item-->
															</div>
															<!--end::Carousel-->
														</div>
														<!--end::Body-->
													</div>
													<!--end::Slider Widget 1-->
												</div>
												<!--end::Col-->
													<!--begin::Card widget 17-->
											<div class="card card-flush col-xl-6 mb-xl-10">
												<!--begin::Header-->
												<div class="card-header pt-5">
													<!--begin::Title-->
													<div class="card-title d-flex flex-column">
														<!--begin::Info-->
														<div class="d-flex align-items-center">
															<!--begin::Currency-->
															<span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start"></span>
															<!--end::Currency-->
															<!--begin::Amount-->
															<span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ $total_artworks ?? 0 }}</span>
															<!--end::Amount-->
															<!--begin::Badge-->
															<span class="badge badge-light-success fs-base">
															<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
																<span class="path1"></span>
																<span class="path2"></span>
															</i></span>
															<!--end::Badge-->
														</div>
														<!--end::Info-->
														<!--begin::Subtitle-->
														<span class="text-black pt-1 bold fs-6">Top Emotion-Driven Artworks:</span>
														<!--end::Subtitle-->
													</div>
													<!--end::Title-->
												</div>
												<!--end::Header-->

												<!--begin::Card body-->
												<div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
													<!--begin::Chart-->
													<div class="d-flex flex-center me-5 pt-2">
														<div id="kt_card_widget_17_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"></div>
													</div>
													<!--end::Chart-->
													<!--begin::Labels-->
													<div class="d-flex flex-column content-justify-center flex-row-fluid">

														<!--begin::Label-->
														<div class="d-flex fw-semibold align-items-center ">
															<!--begin::Bullet-->
															<div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
															<!--end::Bullet-->
															<!--begin::Label-->
															<div class="text-gray-500 flex-grow-1 me-3">{{ $artworks[0]->title }}</div>
															<!--end::Label-->
															<!--begin::Stats-->
															<div class="fw-bolder text-gray-700 text-xxl-end">{{ $artworks[0]->emotion_count }}</div>
															<!--end::Stats-->
														</div>
														<!--end::Label-->
														<!--begin::Label-->
														<div class="d-flex fw-semibold align-items-center my-3">
															<!--begin::Bullet-->
															<div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
															<!--end::Bullet-->
															<!--begin::Label-->
															<div class="text-gray-500 flex-grow-1 me-3">{{ $artworks[1]->title }}</div>
															<!--end::Label-->
															<!--begin::Stats-->
															<div class="fw-bolder text-gray-700 text-xxl-end">{{ $artworks[1]->emotion_count }}</div>
															<!--end::Stats-->
														</div>
														<!--end::Label-->
														<!--begin::Label-->
														<div class="d-flex fw-semibold align-items-center">
															<!--begin::Bullet-->
															<div class="bullet w-8px h-3px rounded-2 me-3" style="background-color: #E4E6EF"></div>
															<!--end::Bullet-->
															<!--begin::Label-->
															<div class="text-gray-500 flex-grow-1 me-3">{{ $artworks[2]->title }}</div>
															<!--end::Label-->
															<!--begin::Stats-->
															<div class="fw-bolder text-gray-700 text-xxl-end">{{ $artworks[2]->emotion_count }}</div>
															<!--end::Stats-->
														</div>
														<!--end::Label-->
													</div>
													<!--end::Labels-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Card widget 17-->
											</div>
											<!--end::Row-->
											<!--begin::Engage widget 4-->
											<div class="card border-transparent" data-bs-theme="light" style="background-color: #1C325E;">
												<!--begin::Body-->
												<div class="card-body d-flex ps-xl-15">
													<!--begin::Wrapper-->
													<div class="m-0">
														<!--begin::Title-->
														<div class="position-relative fs-2x z-index-2 fw-bold text-white mb-7">
														<span class="me-2">You have
														<span class="position-relative d-inline-block text-danger">
															<a href="../../demo1/dist/pages/user-profile/overview.html" class="text-danger opacity-75-hover">{{$total_captured_emotions}}</a>
															<!--begin::Separator-->
															<span class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
															<!--end::Separator-->
														</span></span>emotional reactions detected for your artworks in the museum.
														</div>
														<!--end::Title-->
														<!--begin::Action-->
														<div class="mb-3">
															<a href='{{ route('emotions') }}'  class="btn btn-danger fw-semibold me-2" >Emotions</a>
															<a href='{{ route('artworks') }}'  class="btn btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold">ArtWorks</a>
														</div>
														<!--begin::Action-->
													</div>
													<!--begin::Wrapper-->
													<!--begin::Illustration-->
													<img src="{{ asset('images/16-dark.png') }}"  class="position-absolute me-3 bottom-0 end-0 h-200px" alt="gfdfg" />
													<!--end::Illustration-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Engage widget 4-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
