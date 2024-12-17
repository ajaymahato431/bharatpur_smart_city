<?php

namespace App\Observers;

use App\Mail\ServiceStatusNotification;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Mail;

class ServiceRequestObserver
{
    /**
     * Handle the ServiceRequest "created" event.
     */
    public function created(ServiceRequest $serviceRequest): void
    {
        //
    }

    /**
     * Handle the ServiceRequest "updated" event.
     */
    public function updated(ServiceRequest $serviceRequest): void
    {
        if ($serviceRequest->isDirty('status') && $serviceRequest->status == 'verified') {

            if ($serviceRequest->related_request_type === "App\Models\BirthCertificateForm") {
                $heading = "Birth Certificate Form";
            };

            $data = [
                "name" => $serviceRequest->users->name,
                "subject" => "Service Request of $heading Verified",
                "heading" => $heading,
                "message1" => "verified",
                "message2" => "Please visit the ward office with your original copy of citizenship or national ID for physical
                verification.",
            ];

            Mail::to(users: $serviceRequest->users->email)->send(new ServiceStatusNotification($data));
        };

        if ($serviceRequest->isDirty('status') && $serviceRequest->status == 'approved') {

            if ($serviceRequest->related_request_type === "App\Models\BirthCertificateForm") {
                $heading = "Birth Certificate Form";
            };

            $data = [
                "name" => $serviceRequest->users->name,
                "subject" => "Service Request of $heading Approved",
                "heading" => $heading,
                "message1" => "approved and documents are collected",
                "message2" => "If you have not done this, kindly visit the ward office as soon as possible for report.",
            ];

            Mail::to(users: $serviceRequest->users->email)->send(new ServiceStatusNotification($data));
        };

        if ($serviceRequest->isDirty('status') && $serviceRequest->status == 'rejected') {

            if ($serviceRequest->related_request_type === "App\Models\BirthCertificateForm") {
                $heading = "Birth Certificate Form";
            };

            $data = [
                "name" => $serviceRequest->users->name,
                "subject" => "Service Request of $heading Rejected",
                "rejectMessage" => $serviceRequest->reject_message,
                "heading" => $heading,
                "message1" => "rejected",
                "message2" => "$serviceRequest->reject_message We are sorry for the inconvenience. Please check the form, submitted documents with the required documents and process and try again.",
            ];

            Mail::to(users: $serviceRequest->users->email)->send(new ServiceStatusNotification($data));
        };
    }

    /**
     * Handle the ServiceRequest "deleted" event.
     */
    public function deleted(ServiceRequest $serviceRequest): void
    {
        //
    }

    /**
     * Handle the ServiceRequest "restored" event.
     */
    public function restored(ServiceRequest $serviceRequest): void
    {
        //
    }

    /**
     * Handle the ServiceRequest "force deleted" event.
     */
    public function forceDeleted(ServiceRequest $serviceRequest): void
    {
        //
    }
}
