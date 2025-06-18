<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog des Médecins - Vaccination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- En-tête -->
    <a href="/gestionvaccin/index.php" class="btn-retour">Retour à la page d'accueil</a>

    <header class="bg-success text-white text-center py-4">
        <h1>Blog des Médecins</h1>
        <p>Informations essentielles sur la vaccination</p>
    </header>

    <!-- Section des articles -->
    <section class="container mt-5">
        <h2 class="text-center mb-4">Articles du Blog</h2>
        <div class="row">
            <!-- Article 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://www.leem.org/sites/default/files/2019-04/vignette-vaccination-enfant.jpg" class="card-img-top" alt="Vaccination enfant">
                    <div class="card-body">
                        <h5 class="card-title">Importance de la Vaccination</h5>
                        <p class="card-text">Découvrez pourquoi les vaccins jouent un rôle crucial dans la santé publique.</p>
                        <a href="#" class="btn btn-primary">Lire plus</a>
                    </div>
                </div>
            </div>
            <!-- Article 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRF9YtCFP-q5V9HPvMYoXVu1ImASshOa5GRLw&s" class="card-img-top" alt="Médecin parlant">
                    <div class="card-body">
                        <h5 class="card-title">Questions fréquentes sur les vaccins</h5>
                        <p class="card-text">Réponses aux préoccupations les plus courantes sur la vaccination.</p>
                        <a href="#" class="btn btn-primary">Lire plus</a>
                    </div>
                </div>
            </div>
            <!-- Article 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISEhUQEBIVFhUQGBYVFxUSFRUWEA8QFRUXFhUWFhYYHSggGBolHRUVITEhJSkrLi4uFx8zODMvNygtLisBCgoKDg0OGxAQGi0gICUtKy0tKystKystLS0tKy8tLS0tLS0tLi0tLS0tLS0tLS0tLS0rLS0tLS0tLS0tKy0tLf/AABEIAKgBLAMBIgACEQEDEQH/xAAcAAACAwEBAQEAAAAAAAAAAAAEBQIDBgEABwj/xABDEAACAQIEAgcFBQYFAwUBAAABAhEAAwQFEiExQQYTIlFhcYEjMpGhsRQzQnLRByRSkrLBNGKCovBTwsMWQ1ST0xX/xAAaAQACAwEBAAAAAAAAAAAAAAABAgADBAUG/8QANxEAAgECAgcGBQMDBQAAAAAAAAECAxEEMgUSITEzQXETNFGBsfAikbLB0RRhoULh8SMkUqLC/9oADAMBAAIRAxEAPwDQo1Xo1Zi30qw/8Xyo2z0hsngT8K0qnLwOc69Nb5I0KNV6NSO3ndn+I/A1Zic0Q226t+1G0caPZTvuFeKpKLaknb9x8rVMXR3j4183xF+5/Gx8yTQVzHXE37J8xNaf0niznrS2tlh/P9j6yMQv8S/EVNcUn8a/zCvg2NYMZZJnuuOPpQYRB/7Xxu3P1qt0LczVHGNq+r6fk/RS4lP41/mFXJdB4EfEV+f8C8mFtKP9Vw/3rUZYGZgrRBj3QZ+ZNNHCp7blFTScqbtqX8/8m7zbpYli41rq2YpAJkASQDsBJ50tP7QV5248xcMfBaUdIsOtkIEk6+OqD3cKzeN4VfHD09Xdf31MUsfiHUabsvBW/BqMZ+0+4pIt2rDDkXuXUJ9OrNDD9quI/wChhf8A7rv/AOdYm+NqFAqudGKe42QxFRra2fTsJ+026xGqzZjnoa+xHp1dGYrpFcxqrbtAoQZOgsuraIOqNq+fZSK13Roe0q2FKCWtYw1sTVnLs9Z2fT8CzMr162xU3nkcRIMeu80hxmPusSS8/mVT/anvSD7+551m7441c9qKqCV9u0pXGXJ4r/Iv6U7wFxyPf+CqP7VnkG9aPLRtVdPeWYm2ruNJkahw+vtQsieXwrD5ju7E99bvo8PvPyn6VkcVlt5iWS07A8CqsQfUCnb2u5Vh4pWsvH1E2GXtVpsOvZpdhchxOqeoufyN+laHCZTfIKC05YAkjSdgOJpISS3stxEJSexNk8SP3E/mrD3lr6dgsme5aWy6MAW1HwWmC/s3wx4s/wAarqV4R2GjC4WrJXtbdv2Hy7KRTu2O2vmK1mI6IYe02lNRI76YZf0dwzWluGdStBpVioJBno2tOTewxOe5Xdu3tSISBG44cK9ayW84KqhJHGvqJNm0hUECe+o9GMNBe5Mhtqqli2tyNcNFRlZSZi8H0Ve/aFt5WKX3ujSWW0aia3+YZgbROneszjsWXuAsInnVbxE3tL4aPpRWra4VhuhVtALwbcioZRkiviArAEDc+NH4rMB1Yt69+VAYe69p+sUzVbqzkt5ojhaUJXSNDnWBs2RsoE91Q6JWba6m2k9/dSPMc4e64DDarrAI4GJpNrVi74YyukN8wzAhyqCR4V6yGImaAyxSHM7zTs3UG1QHM/N6XI4KKaYF2buFLAKbZaK6VPeefxFtU0+Q4VXaH3qWeqLdzSggbVd0dHaqvpIPa/Cr77TmtLUTtzAr1LMWKaXhS3FCnYlB7RTiRQsUZiRQug1mqbzrU3sDMtG9arKV9otZjLl3rVZT74qyGUw4h/6iGHTAfd/85isvjVrZ5tZF2/YtcdTKCBxgsJ+U1dj+jWGhzNwEXhZABUgnsGfdng/ypJVo00lIupYWpXm5Q5M+YYgbUKFr6h/6DtNxuP8A7f0o+x+zTDkSbtz4L+lVSrwe25vjhKyVrfyfO8oWtZ0c+8rRXf2fWLaFke8Su8Apw/lq7KMiw/XMih9PVWrgJc6puTIOmO6j+qp6tih6NruprbPmZh8mOJvYghwvVDUZEyOH6VS37Prz8Llv11fpW5+zWU64WVUDs2WgyS5IdpJ3MLHE0QMWJhazyxUm/h3HQo6NpxgtfbLm034mDtfstvc71v8A3fpRg6FPZIVryAEqJAYxqMTFbXF52tlQzjj49wmkbdIEvTKEh9uceG8UqxFRbiyWj6Esy/llGB6PdW11Ot90MGIXcREbTzmtHl6W7NtbYOygDfjVd+2q3LpE6roUnyA3+c1RasmZ3pJ1ZzzMtpYalRyKw6OMtqJZgKWWMUHxAe20ghkPcQR+oFLM8s+4SCRMc43765hkKMrIANPLlvVdi/Wsw/Cu5VjEaCEHjp4moYjMHRS3dyqjC47TcZLnutLCOR5iq81zCzogKxnw50bAuJcdnN9zIA8aa5FiostrIkmaWYV1ugkiNPOi/snYOk7GjYmsXZtaB0mdqGGNu2hFs9mq8GrP2Hns8Dyo5cF2t6BLtAyOXUy0sd6F0M2zrTKxhAt2TwNdzuz1bjSeNRBavtM7jcAVIIJp7hMGxthm5UNcJPETTnBXD1DVCJX3iU211gnhTXMUVVUrzpfZwWveaPza3CL/AJanOwbfDcFy28wugRtRmLbtGq8BcHdXMUe0aF9o2qrHw4Cm2Wim+F6H3X7hWhy/oBcG5cCujGpCL2s89UoVaitGLBuj3vVZmNsPiUHGSvrvTTBZELdzq9e9OsJkNtX6w9phzPKpPEwW4Sno2s7J2VntK8XkWHKljb4CdtqUZn0ewo0ABgzgGAf8s1rMSAR1fO52QOfjS7GYdXuqysB1ex58BEVh7aa5s7n6Sg9uovkY1+ids82+X6U3wHQPDsJYv6Ff0pvibCtwc+gFHYa4LaS7bLxJgfGm7afiJ+jpf8UB4ToFghyc/wCv9BQ+IyWxZuYdVtb3HZHlnMhZ3G/MQadYPMUddSMCO8TVeY3gQl5l3su+nkCerBBPwI84pe2n4sb9JRtkXyQYMPYw6td0IgUEs8CQo4y3GlF3Q/V7wbh+1GNxpeNPyQfClebXrmYYn7NDW8Hh9L3mOxxGwZVHepkUdfvdZcZkXjAEDgqiFH/O+k2tl6UYrYG3boY9kn0AirMZmxsWtZg7hRseJ749aowuEbjBq3NMva5ZdNMmJX8w3FQmwVYjpc6KHmd+Swp/m3+dE4zG3BaF7DBFu4m0irqMKpJZhHiBcWBznwrIrl1y4JaZG2+8HmPOnmDwx6sWiNUAT3iBAI8QAPhRsBvYNMFgTZsrYBLsCXuOeNy83vGisJgWG8GgWu4jqwtt912MgBj3STsDw35zy2nq4fFlH1C5qgaYMyZ34VLAvfaX57l7MqHTsjSZ3AWDxqm2wIiI7iPd9IpTYwOOJ7a3SOckwfnTHNIsXEFowXUEoQQNfPjtRtYm8tvXW1hu0Sv4uPmKvbHYhlbqoYgAqFHEHzqzDMxHaAE91cuYC5bPWIYUdrUpnqyeII5qflUAC4Z8dcIS9ahDxMDb51W7vaum2wJWdiREjzp11zxux9OFU3Ibd+1HfyqBsC4vDdYvZ2Ybg+NTu4m5Zt9u2p2mDw9DXb11YIip52f3ZTxhZ8Yocw2SV2Z8Y0O8hFWe6nFmCIpPhMFqCuDx3pxZsmjJ2JFXVy3KoFzQIINDYm77UqOVG5fg9L65pTizpxDHwqRV7sE56uqvFlgwtxnDDgDV2fWZZGNX4HEyJio54ZC0IO7HmrRB7Gg91MFA0GO6leFtgHYUxUdg0vML3CrCTq40Tmk6RVWEAmrc190UyzivIRwSVzEt2qjgGJrmL940o5ZhcOwE05weI2AalhauJd3G9S4FFF1zCacQXPA8KMxmJW0hdzAHzpTnOYEMdO8AH4UFYwzYu6r3XHUoJK85HI0Xe1xVbWsTwmJuDXj7u0gph7fdP4jQeCYosFpZiST3seNU53mXW3YGyJsijuFQw2J7l9WqKIZS5Ib4UkmmyKCIIkHiDwNIBjHFu5cVgNERAiZ8DxoXA9KL0gOFYEx2lIPxFHVF1jSv1dpeSj4CkpzE3mbSJsoCpn8ZPGPnTO7iLd6yXewSAYOljt6xWWxiqp9i1xFMdg9pZ8SePwoWCmOsFda2OpJ1W2+7Y/hjglzwHfQ+JzG+hKkhNPJV47cieNF5figVAbfxiNxTa1eCLBaAY0mJAnuHd4cqe5WlbYInxL9VcZneYXT2pAncyR7ppRl+a3gwi6/P8TEHu47VutTctBnvSZ/3VwNcH/T9Lcf91S4bCnNrJuWrV4N2rgIJUhXkeQ7Q8DNLspxL6onVGx2+sGtU2JukQWXf/KNx6mgsNlFm3JWQW3O5iT4cqUa1y23aY9sKZA3C7lh3R/zjVtnEFjsTBBKkFoIEAiORE0Tg1IZdLEeG5Dbc96W5zj7eFbrXB0lnEIATrY8dyO6pG7dkCVoxcmw4l/42+Joe5aVmBftEcNW8UNl+f2cRq6sP2YnUAOM+PhV+veaMk4uz2MFOSmtaO1FoKA8KJwIEXSJ3AkTsfShEsyeNHYCzCmT7+x5cDypGy5LaK/tUEpHAneamrzS3NMR1bqoA7ZiWMKsSdz31Zl2MNxSShUiYPFHgxIPdRldOwkLSSl4h64UEiee1W51bAsEclUgfCoYC6WgmNjG3lU87abLeR+lNSzorxWyjK3gZ3DYsrbQAfhmmdrEEqGiPA0BgQ3VpCg7cTTGCV7UelLUzMspZI9EMsI/PvpFi/wDENtyp5huFJMW+nEMfCnp7pdCqvnh1+wfhFMbiq86/BU8Hdmo54NlpIby6plKLN0E0cvuGleETeKbqkIfKhzDyEmGXtetGZqsIKEwx7XrRuce4KZZxXkKcr413Fr2jXMsom/hiTNLzH5A+qoGs1l+OfvNafHYdhZW6GiaZxK02CYshe0aqtoR7S3wPvL3jvFKr19g0F+NMsDiyBsJ76K2AktZHGydW9ohJB5DiKlYyzTG5271NM7Lgdu3x5p30dhyGEjbw7jRFQmxmCW5ql9M9ynal+H6P2lMm+38jVqjbqDAVLhtcjgHtW7b2xcYh+PZM+m1KM1ytrmn7NMA9o3NvhTU3I5VbYu0o6QNlWBNv30Vv93w2phmNpVNt0BA0tqSPe2EbeBPyrttt6KzM9hZ7j9KVjJIFy9T1ST/CK7cFfKc4UrfuDcb+XEA1u7fAeQrTWpdmou97mLDYhV5TilbV/v8AgY3anx4fKhLYo7DVmcjaohOA/CwEjj5is505XVau6o9kyFY562Xc+jHatLlf3aflFZ7pr9ziPO19bdaMMl2vT8nP0jNrDq3Pf8mxD0RvKiXncwqBSSeAA1TT7D5taLi0xKO41Kt1SjXF71nj5cRzFZ/ovaRrd9bsaCFDSYAWGnfl503wd7CB98Sl120qOsuo7ABpVVA24wZiSY32FTGcaXl6D6M7rDz9WPbOIAfRpae/SdPLnEc/kaZ4Q7D1+tJ0tk3gTwER2X4wZJM6fT/gbYfgPX61m5G/mZ7M2bWAtvXPGSABE8Zq3Ds8HWoUAcmn+21ex95UYljA4eZngBzrmCvBlYKSxEmGBBE8BB5U08zKqPDXQMwCQAO4+PMeNSzr7hvI/SuYHwECfWY3rudfcN5H6U1LOivF8GfQR4G9FtFiSRyo63dBXy4zSvDKNFs89PfFNMNZ7MRx9aFTMy2lkj0QzwvCkeOHt28qf4URtWfzBovt5U1PdLoVV80Ov2D8sUGvZ9sFruVnlXs/Oy+dJDMX1MoDgj2p76cn3T5UnwjCRtTge6fKhzDyEeFPa4c6Y5jblBSy5iAh8Zo/MwxtqV4mi81xUvhsD4C6NYSjcRiirRFJcuw10PqNOjbJ40OYbXW0xWXYTRzNah8Tqsi33VHSo5VYjjup2xEheuVhtwvqaa5RgDa4gGatsXKItuZoMKViGcYZQyXEWCOMc6UjP7NkkXiQWJOykiPStHmR2WvmPSse0HkfrVuGpqc9VmbHVnRpOcd+w2eGzuzdGpGJAMe6RvU2xiHhPwrJdGPum/MfoKdpS1lqTcUWYaXaUoze9hxug1Yt3SrNHAE/ATQiGrncG28Ee4Tt3QY+hqtO7L2rRbG+HWd++g87c67SyYhjHKQRFG4XgKAzz7215N9Vq3Dbanz9DFpN2wzt4x+pHz/pN/irvmv9C00zfFOt5Ee7dsWOq1C5ZQMbl/UQUZij6IXSQIGosdzEUr6Tf4q75j+ha0d/MLq3BatYdrkW1cvrVLY1My6QW4sNMkdzCtONyQ9+Bj0RnqeX3OdF7+LZQcUqlWDFXINu/pDkWxdtRAZkh5EROkqImjsp1/aNLG8QkmSLXUr72kMRcZ9RFzYQJCgwIFRy7EYhmi7YW2sSGF7WxaRA0hAAIneeXDerMnsItwOOqi490KVsMrl9TF5uM5mdLmQoDQTXOO4h7gnIS3HDSJ4RMqBufM7ce6kfTE+wv+dn/wAdOcIJW1sfc5d+q2e+eXKkvTI+xvz32f8Ax1rw3G9+KOVpHu0ff9LE3Q+0rreVgCraQQeBHarTpcAcIFO6ltQHZEECCe/f5Gsf0fxnU2MTegHqkDQTAJAYiTyFNPt/V6W+2pccsitamzofW6qwRVGsRMjtHhvNDGcaXl6FujO6w8/VmitDt+8I1LOx1K0bAHhB/v40zw3L1+ppSgPXCEMHctJKlgNuyDsfE+FN8KNgfP6ms3I38zL52vtEfVp0EkSpYGQRwFTwB1Mzl9R06dkZBEzz413Nj2ttc8ur48+M7R51ZlnW79aVj8Me9H+aNp8qaeZlVHhroHZakACCO1zM1PPvuG8j9Kst8vOq+kP3DeR+lNSzorxfAn0M5YPsrY7xyG9NstgLCzt38aVYFexbKmG0/KmuAAE7yZ386FTMy2lkj0Q2w3Gs7mDRfbyrQYY70nxVj2zNypqe6XQrrL4odQnLiJ2rmfDsqe40JbzJUcIBuTROd3CIHKKrWxl7s0AJiwOVNMLe122I5VmL1pm2inOWWmVI33qMiFL4G4zzymn1u2wUA8qtRaKu8BQIU4cb1c/GuW6k1QIgY15Gqs1K3R1gaodhrg4UZaBpXg/eNNrNSTJFXFGcZm+sWjyrKdLPfT8tPc7/AMR6CkPSw9tPy12KEFGMWvA8jiq051qik9zsirBJdODuiwYuEmI2PATBPAxMVyzhGe5aGFF+xok3XuA6WGnZWVyQ5LRuOQO9XZRieqwz3Apcq3ur7zHYQKPTG4nlhfjeQfQGubieLI9Jge7w6B7oxte1I1LBJQ6FlTMgmdI2mpZWkWrp0FeyQCbjOWUKSDBA0iSahc7Vr2qoC0SrDrEDEiBG2reKIw6BEup2ZCkkIgQQVMHiZ4H4VSt6NMsrHiE9nugc4HFfWg829+z5P/UKLQbrx4cvNf0oTN/vLPk31FXYbi/P0MOlO7PrH6kYLpN/irvmv9C1s7fAeQrF9Jj+9XfMf0LR+cYpDiUsX7jpYWyLkIXXr7rOVCsyblVCE6Z31CeFacblh78DJojPU8vuafLus0nro1a7kaeHVdY3VeujTPjNRyk2w9tlB9o14KpuFha0s2tgh2AJEH+EuFGxNI8ju2xitGFNw2XtOzhhe6q3eR7YQobggFle5IU76AY73GSq5xD3CtrS0jVhzbILKxA69tnZ4jaIBkcga5x3EPML7tr8oG8RJe2OY491JumYizfHcbI+duneCQaLbcwFAPMKWQkeulaR9NT7LEedr62614bjP3zRytJd3j7/AKWIeizxbvnYQF4qXUe9xUbnyFOctuO5lMRh2AO4tWTqjmPvTpPpSbokxC3ipAICwW90e9uY5UVhXw925buXna48jq36p7eH18tDxDTylmnlQxfGl5ehbozusfP1Zq7OHBcOeI4Rt8SN28jtTPCcB5n6mgMOaOwR7I9fqazcjfzMrns61kMbc9sLMxvExuRPGrMrA1k2wRbgcQQC88QD4VVnN8pdQzCT2yOQgxPcJ51dgsTruHQ0ppG/4Q88jz2pp5mVUeHHoObZ4edV9Ij7BvI/Su2jw867nR9n/wA7qak7TTExS1qMkZ3L7RNtGUwQsU1wdvTxMk8aU4FifACmn2xQtCW1tlkNkUhlhLo1RO9J82xBViahk4IvFzOn5UZfsrcYk0t7DONxHhl6xw3CKfuSxlq7Ywag7CirtmIoDWBxaHdRdlBFQFurVXaoQqVRVjiohamwqEIotdIryiumgEyt25A1caow+O1NABqZthVIFB5eSXneO6oQd4Q9pqY2r/dSzC+81F2KMt4I7hNnZ/eB5CkXSv30/LTzOz+8DyFIulZ7aflruUcsOh4yt3it1CejP3TfmP0FMr11w1sIuoM0Of4E0k6viAPWkOXY3qcLduxOgkgfxGBA+NG2sHiius4nS5E6RbQ2Qe4z2iPGRXKxPFkeowXAh0G+MClO0SN1gr7wfUNMeMxVtoAC8pLM2iSzR2lKtpiNgBDbUuw2MF3DLduIe0AStuSwcGOzG+xGxojK7wa1dYf5wQWLXOyCAWJ+QqmO9GmWVmiU7r5d081obORFyyPBvqKJW3IB32AEcuKmflQ2en2tryb6irsLxfn6GHSndX1j9SMB0mP71d8x/QtOM2zA27iJ9ss4cMq7XrJYOxLe7dNxVnb3dztPMUl6Sn96u+Y/oWnub4q4i+/h7VrSNV3EEmGJjSLfZB2jcvxPCtONyw9+Bl0TmqeX3GWW2rwOq5iBcUjYLbVFmR2gQSTwPPnTDA4FBc649q4QVDsBKITOlYAgbDfiY3JrN9E8FhF13sLdW6zmHa2yBNRgx1VoBFOw306vE1rMMa552kGZeCbSR3IfQEH+1Iemp9liPO19bdPsqPs0/KPpWe6an2WI87X1t1rw3Ffvmjl6S7vHr/5Zm8hwvXWcRZmOsULJEgEhuI5jvFPiL95VtXLS2xqQuwcMCEYNFsRO5UCTEVnskW4bGJWyYuFQFgwdUNwPI+NN2xK3Ut2bKXQytbI1JcTqAjAks7CDsCIBOqe4k0uL4z8vQu0b3aPn6s1mHNH4E9kev1NLcOaPwJ7I9fqazcjdzF75eznWCIPI+Bqu5a0DeNu6rjbxMTb06N4njxM8qS5jmbW9ro+HCrJWuzNSctRL9id3PNPBeHeaZ5i5exbaN2Ekd9Isqu2sQ+ggqG5gDb1p5i0jTaRpW1sD4UlzQl4iwMduxwoa9gndpGwp3aBohVqXJYDy6wyrpmjAkbVfh1E1503oBK0G9W3TXUSuulQhBWq3VVYWpxUIcBrpNRiukVCHRXq4K7QCY6SE7Z3qvDgAqd+1V2IiDPCh8OoBUkkzw8KhBphT2mozD0Dhj2mozCidqMgR3CXOz+8egpF0qPbT8tO88/xHoKRdKT20/L/eu5SyQ6HjK3eKvU9l1tGwtxbillJMqs6mG3CN6ilqz/8AHxbeZuf9z1bkizYcaisse0pgrsNwTVP/APSvIdNi4MUR+DRDT43V7A9RXKxHFkepwXAj0H+EthbKrbtvbAGyDSHTfhuSPnRdhLgtXOsYMSrRAEqNPAkRqPjAqvCOxUF10sRuoOoKe6edFXT7N/yt9DVMd6NEsr6DZD2R/p5TzFB58fa2vJvqKNwp2HkKAz4+1teTfUVfheL8/Qw6V7q+sfqRgekp/ervmP6FplmBFvF28ReRmtLa0Iyo1wYa+WJdmVQSupdI1xtpI2ndX0lP7zd8x/QtPPtznFrh1IVUs9c0iXu6mNtVXuCkST4qOZrRjcsPfgZdE5qnl9yWX3BexYxNpGFtLT22uOjWziHZ0ZAFYAsqBX7XD2kCd41WGNZwYtxi1tagUuWWfTA1Wnt3FUNPMOLhEHnb250/wprnnaGGVH2aflH0pXnmXNiTesIwDMbZlp09kI3LypjlR9mn5R9KDxF24L93qRLkoANt5RZ4+E1ootqcmuS+6OfjIqUKcXzkl/1YuyTotew+vW9s6tMaS3Ke8eNGXV0cT8Kncu4/8VoD+T9aU43Hsp9sI8hM/ClnLXetIvpQ7OKhHcixs+KmFQeZP9qbZHjmdLxaOwsiBwmay4zG0WGlePPSP71rb2EFq0Wt3DN9YKvG3CIA4c9qqdjQrkWuXwNKMukcNt4O/wDegL2Wm4ZuQfSi7VsgDeiUJqAsgTCYBU4CPKj2tgLsK6pq+5ECgMCLVqiuqlTVKhDyVxjvVirUWWoQ6hqTNUVFdYUAs8DUpqAFSqEPV0io12oQ8K7URUqIDD274uW9XI0PgbgL6QZ0/Kp4Szot6Zmq8DGvZfUcKARzhfeaj8IsGKX4Q9o0wst2vSjLeCO4QZ6f3j0FIelB7a/lp3np9v6CkXSc9tfy13KWSHQ8ZV7zV6nsFftphbjXRqQEysTq2ECOcmKIsHGaQyJYQRIsnVMcgXGwPoaHy3Crewz2mmHJEjiDAgjxBq9LeM06Dcsxw63S2uO/Rw1eMx4VysRxZHqcFwI9BzlWNF60l0AjWN1PFWBgg+RBFH3T7N/yt9DS7LsOtq2ttJhBAncnvJPMnjRt0+zf8rfQ1VHejRPKx3hTsPIUvz9va2fJvqKNwp2HkKW9I29pZ8m+oq7CcVefoYNLP/aS6x+pGD6S3P3q75j+ha0mMwFq9pNwHUnuujMl23I30uhDCeYnetRZx2GCBbht6gN9SyZ84qnEZjY/CyegP9hVlep2lo7rC4Kl2Kct+tb3/Ily3AWrMm2DLxqd2Z7jxw1O5LGJMCdpNMreOtp7zqPXf4DelOZPrHZI+Y+tAPgGjcgfM1lcbHQjNvka7JcyRurtLJJAExAG3jXswutbxGu2uoht9+OlQv0pbkmEZGt3QrlEYFmC7RR9xmVnkRqdmAMSFJ4nuqX2k1U0r8i+7n95tupj/UP0pNjcM189sR6/pTZLs8RVqqpoXDqoU4DJkQyNj38T86eWbAmTuQOJ41wWhV9lNjQGRUakKiy11RUIWrU2O1VipNUAeU1YrVQKmDUCi8NXCagDXCahC0V01UDXSaASVdqAapBqhD1dqM1IUQHhUq8BXYqAMLbVYheFW2ABwrteoDF2EPbamlkCZr1eppbxY7jNZ6fbnyFIOkzdtfy12vV26fDj0PHVe9VepQjP9iu9VOqT7vvRtq0+MTR9rHYYWI6xTb06YLSxERpjiT4ca7Xq5OI4jPU4PgR6BfR1XXD2xcnUF4Nu4WeyGPeBFN7rezf8rfQ16vVXHei+eVjfCHYeQpd0j3uWo5Bj6SK9Xqsw8tWd/wBn6GXH0lVo6j5uP1IZWujuGuItxrjBnUEgOgEkdxBoXE9HsOgkXG/1On9hXq9SXu7lqWrFJcjK5oSjRbb+UajVFrr7h3LebnSPhxPwr1eoMsjuNzgcwdLC2UEnmxBCjynf5VX1RHvbnn516vUo5NVq1RXq9RYC1avtmu16gEiTUlr1eqERMLXWWuV6oRkdNdArleoBJiuGvV6oBnhXjXq9UCcqQr1eogOipCu16oA6KlNer1Qh/9k=" class="card-img-top" alt="Vaccin en laboratoire">
                    <div class="card-body">
                        <h5 class="card-title">Les derniers développements en matière de vaccins</h5>
                        <p class="card-text">Découvrez les avancées scientifiques sur les vaccins.</p>
                        <a href="#" class="btn btn-primary">Lire plus</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section d'inscription -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h2>Recevez nos mises à jour</h2>
            <p>Inscrivez-vous à notre newsletter pour ne rien manquer sur la vaccination.</p>
            <form class="row justify-content-center">
                <div class="col-md-6">
                    <input type="email" class="form-control mb-3" placeholder="Entrez votre email">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">S'inscrire</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Pied de page -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Blog des Médecins. Tous droits réservés.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
