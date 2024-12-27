@component('mail::message')
{{-- Hero Section --}}
@component('mail::panel')
# New Job Opportunity

We are excited to announce that a new job has been posted: **{{ $job->job_title }}**.
@endcomponent

{{-- Job Description Section --}}
## **Job Description:**
{{ $job->job_description }}

{{-- Location Section --}}
### **Location:**
{{ $job->location }}

{{-- Application Deadline Section --}}
### **Application Deadline:**
{{ $job->application_date }}



{{-- Footer Section --}}
Thank you for your interest in our opportunities!

@component('mail::footer')
{{ config('app.name') }} 
@endcomponent
@endcomponent
