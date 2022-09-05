<?php

namespace Codebase\API\Http\Controllers\Domains\Clients;

use App\Domain\Client\Models\Package;
use App\Domain\Client\Resources\ClientResource;
use App\Domain\Client\Resources\PackageResource;
use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Support\Services\APIResponse\ApiResponse;

class PackageController extends APIController
{
    public function index()
    {
        return ApiResponse::success(PackageResource::collection(Package::get()));
    }

    public function subscribe(Package $package)
    {
        $client = auth()->user();
        $requestedPackage = $client->packages()
                                   ->wherePackageId($package->id)
                                   ->active()
                                   ->first();

        if(is_null($requestedPackage)){
            $client->packages()->create([
                'package_id'    =>  $package->id,
                'start_at'      =>  now()->toDateString(),
                'expire_at'        =>  now()->addMonths($package->duration_in_months)->toDateString()
            ]);

            $message = __("Subscribed Successfully");

        }else{

            $requestedPackage->update([
                                    'expire_at'        =>  $requestedPackage->expire_at->addMonths($package->duration_in_months)
                                ]);

            $message = __("Expire Date Updated Successfully");

        }

        return ApiResponse::success(['message' => $message, 'model' => new ClientResource($client)]);

    }
}