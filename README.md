# Bongkyu Kim's Resume API Document
## 1.Summary
> 기본적인 이력서 내용과 여태까지 진행하였던 프로젝트와 관련된 경력에 대한 내용을 담고 있습니다.  
> https://resume.bnine.site
> 해당 사이트에서 구현된 내용을 확인 하실수 있습니다.  
> Front-end는 React.js로 구현 하였으며 Back-end는 php와 laravel Framework로 구현 하였습니다.    
> 각 API의 자세한 사항은 아래의 SwaggerHub의 문서에서 확인이 가능합니다.  
> https://app.swaggerhub.com/apis-docs/Bnine/bnine-resume-api/1.0.0
## 1.1. Notice for API 
```
1. 모든 API는 무분별한 호출을 막기 위해 JWT 토큰이 필요합니다.
2. Request Header의 'Accept-Language: {language}'를 통해 다국어 Response를 구현 하였습니다.
3. 현재 구현된 언어는 ko, en, jp이며, 각각 한국어, 영어, 일본어 순입니다.
4. postman이나 기타 Tool을 사용하여 직접 API를 요청시 다음의 토큰을 사용해주세요
5. Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODA4MFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY3MjkzNjkwMSwibmJmIjoxNjcyOTM2OTAxLCJqdGkiOiJObmlxZlZEME9VZlBiWnkxIiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.kr72QjV0fe4b-LjwjTnjrRkmpvlpLIgn8wK2jXCr8aU
```
## 2. Server Configuration
![server](https://image.tmpbnine.store/resume-japan/png/server-config.png)
## 3. ERD for DB
![server](https://image.tmpbnine.store/resume-japan/png/erd.png)
## 4. API Routing
### Endpoint & SwaggerHub API Specification
1. (GET) https://resume-api.bnine.site/api/v1/profile   
    * https://app.swaggerhub.com/apis-docs/Bnine/bnine-resume-api/1.0.0#/profile/get_api_v1_profile
2. (GET) https://resume-api.bnine.site/api/v1/profile/projects
    * https://app.swaggerhub.com/apis-docs/Bnine/bnine-resume-api/1.0.0#/profile/get_api_v1_profile_projects
3. (POST) https://resume-api.bnine.site/api/v1/contact/sending-email
    * https://app.swaggerhub.com/apis-docs/Bnine/bnine-resume-api/1.0.0#/contact/post_api_v1_contact_sending_email
<!--
> ###Endpoint & SwaggerHub API Specification
>   > 1. (GET) https://resume-api.bnine.site/api/v1/profile
>   >   > * https://app.swaggerhub.com/apis-docs/Bnine/bnine-resume-api/1.0.0#/profile/get_api_v1_profile
>   > 2. (GET) https://resume-api.bnine.site/api/v1/profile/projects
>   >   > * https://app.swaggerhub.com/apis-docs/Bnine/bnine-resume-api/1.0.0#/profile/get_api_v1_profile_projects
>   > 3. (POST) https://resume-api.bnine.site/api/v1/contact/sending-email
>   >   > * https://app.swaggerhub.com/apis-docs/Bnine/bnine-resume-api/1.0.0#/contact/post_api_v1_contact_sending_email
-->
## 5. API structure
- Middleware
```
    * /app/Http/Middleware/Localization.php
        * For setting locale for Localization languages
    * /app/Http/Middleware/JwtMiddleware.php
        * For Handling JWT
```
- Controllers
```
    * /app/Http/Controllers/ProfileController.php
        * Handling Profile API
    * /app/Http/Controllers/ProjectController.php
        * Handling Project API
    * /app/Http/Controllers/ContactController.php
        * Handling Sending contact Email API
```
- Services
```
    * /app/Services/UserProfile/UserProfileService.php
    * /app/Services/UserProject/UserProjectService.php
    * /app/Services/Contact/SendingEmailService.php
```
- Repositories & Interfaces for Repository
```
    * /app/Repositories/UserProfileRepository.php
        * /app/Repositories/Interfaces/UserProfileRepositoryInterface.php
    * /app/Repositories/UserProjectRepository.php
        * /app/Repositories/Interfaces/UserProjectRepositoryInterface.php
```
- Models
```
    * /app/Models/ProjectImage.php
    * /app/Models/User.php
    * /app/Models/UserProfile.php
    * /app/Models/UserProject.php
    * /app/Models/UserProjectDetail.php
    * /app/Models/UserProjectImage.php
```
- Route
```
    * /routes/api.php
```
- Customized Config
```
    * /config/images.php
```