package com.seoul.app.home;

import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
@RequiredArgsConstructor
public class HomeController {

    // 홈 경로에 매핑되는 메서드
    @GetMapping("/home")
    public String home(){
        return "home"; // home 디렉토리 내의 home 뷰를 반환
    }

    @GetMapping("/user")
    public String user(){
        return "user"; // home 디렉토리 내의 home 뷰를 반환
    }
}
