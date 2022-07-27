@extends('admin.layouts.master')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Add NFT</h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4 border-0 shadow">
            <div class="card-header border-0 bg-gradient-primary text-white">Add NFT</div>
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="profile_img_wrapper">
                                    <img width="100" height="100" src="http://localhost/cataboltswap/assets/admin_assets/img/user_images/default.svg" alt="">
                                    <label class="profile_img--overlay" for="pf_img">
                                    <i class="fas fa-upload"></i>
                                    <label>Upload</label>
                                </label>
                                <input class="d-none" type="file" name="nft_image" value="" id="pf_img">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="small mb-1" for="inputname">NFT name</label>
                            <input class="form-control" id="inputname" type="text" placeholder="Enter nft's name" name="name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="small mb-1" for="inputindividual">Individual NFT's Price ($)</label>
                            <input class="form-control" id="inputindividual" type="number" placeholder="Enter individual nft's price" name="individual_nft_price" required>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="small mb-1" for="inputinddepositAmount">Ind. deposit Amount($)</label>
                            <input class="form-control" id="inputinddepositAmount" type="number" placeholder="Enter individual deposit amount" name="ind_deposit_amount" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="small mb-1" for="inputset">Set of NFT's Price ($)</label>
                            <input class="form-control" id="inputset" type="number" placeholder="Enter set of nft's price" name="nft_set_price" required>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="small mb-1" for="inputsetdepositAmount">Set deposit Amount($)</label>
                            <input class="form-control" id="inputsetdepositAmount" type="number" placeholder="Enter set deposit amount" name="set_deposit_amount" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="small mb-1" for="inputmaxnfts">Max Individual NFTs</label>
                            <input class="form-control" id="inputmaxnfts" type="number" step="1" placeholder="Enter Max individual NFTs" name="max_individual_nfts" required>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="small mb-1" for="inputmaxset">Max Sets of NFTs</label>
                            <input class="form-control" id="inputmaxset" type="number" step="1" placeholder="Enter Max sets of NFTs" name="max_sets_of_nfts" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="small mb-1" for="inputavailableIndNfts">Total Available Individual NFTs</label>
                            <input class="form-control" id="inputavailableIndNfts" type="number" step="1" placeholder="Total Available Individual NFTs" name="total_available_nfts" required>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="small mb-1" for="inputavailablesets">Total Available Sets of NFTs</label>
                            <input class="form-control" id="inputavailablesets" type="number" step="1" placeholder="Total Available Individual NFTs" name="total_available_sets" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="small mb-1" for="inputownerwallet">Owner's wallet address</label>
                            <input class="form-control" id="inputownerwallet" type="text" placeholder="Enter Owner's wallet address" name="owner_wallet_address" required>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="small mb-1" for="inputlaunchdate">NFT launch date</label>
                            <input class="form-control" id="inputlaunchdate" type="date" placeholder="Launch date" name="launch_date" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <input type="checkbox" name="credit_option" id="credit_option" value="true">
                            <label for="credit_option" class="ml-2">Enable credit card option</label>
                        </div>
                    </div>
                   
                        <fieldset class="border-secondary">
                            <legend>Installments</legend>
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-12">
                                    <input class="form-control" id="inputinstallment1" type="text" placeholder="Installment 1" name="installment_1">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <input class="form-control" id="inputinstallment2" type="text" placeholder="Installment 2" name="installment_2">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <input class="form-control" id="inputinstallment3" type="text" placeholder="Installment 3" name="installment_3">
                                </div>
                            </div>
                        </fieldset>
                    <!-- Save changes button-->
                    <button class="btn btn-primary" type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection