package com.seoul.app.start;

import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
@RequiredArgsConstructor
public class StartController {

    // 시작 경로에 매핑되는 메서드
    @GetMapping("/start")
    public String start(){
        return "start"; // home 디렉토리 내의 home 뷰를 반환
    }

}
